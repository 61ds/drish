<?php

namespace common\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $items_count
 * @property string $price_total
 * @property string $delivery_charges
 * @property string $grand_total
 * @property integer $status
 * @property integer $locked
 * @property integer $payment_method
 * @property integer $payment_status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property OrderItems[] $orderItems
 * @property User $user
 * @property OrderStatus $status0
 * @property PaymentMethods $paymentMethod
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_method'], 'required'],
            [['user_id', 'guest_id','discount_id', 'items_count', 'status', 'locked', 'payment_method', 'payment_status', 'created_at', 'updated_at'], 'integer'],
            [['price_total', 'delivery_charges', 'grand_total','discount'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::className(), 'targetAttribute' => ['status' => 'id']],
            [['payment_method'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethods::className(), 'targetAttribute' => ['payment_method' => 'id']],
            [['guest_id'], 'exist', 'skipOnError' => true, 'targetClass' => GuestUser::className(), 'targetAttribute' => ['guest_id' => 'id']],
            [['discount_id'], 'exist', 'skipOnError' => true, 'targetClass' => DiscountCode::className(), 'targetAttribute' => ['discount_id' => 'id']],
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'guest_id' => 'Guest ID',
            'items_count' => 'Items Count',
            'price_total' => 'Price Total',
            'delivery_charges' => 'Delivery Charges',
            'grand_total' => 'Grand Total',
            'discount' => 'Discount',
            'discount_id' => 'Discount ID',
            'status' => 'Status',
            'locked' => 'Locked',
            'payment_method' => 'Payment Method',
            'payment_status' => 'Payment Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(OrderStatus::className(), ['id' => 'status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount0()
    {
        return $this->hasOne(DiscountCode::className(), ['id' => 'discount_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethods::className(), ['id' => 'payment_method']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuest()
    {
        return $this->hasOne(GuestUser::className(), ['id' => 'guest_id']);
    }

    /**
     * @inheritdoc
     * @return OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersQuery(get_called_class());
    }
    public function getPayments()
    {
        $group = PaymentMethods::find()->orderBy('method')->all();
        return ArrayHelper::map($group,'id','method');
    }

    public function getOrderStatus()
    {
        $group = OrderStatus::find()->orderBy('id')->all();
        return ArrayHelper::map($group,'id','name');
    }

}
