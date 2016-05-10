<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $user_id
 * @property integer $color
 * @property integer $width
 * @property integer $size
 * @property double $quantity
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Product $product
 * @property DropdownValues $color0
 * @property DropdownValues $width0
 * @property DropdownValues $size0
 * @property User $user
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id','color', 'width', 'size', 'quantity'], 'required'],
            [['product_id', 'user_id', 'color', 'width', 'size', 'created_at', 'updated_at'], 'integer'],
            [['quantity'], 'number'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['color'], 'exist', 'skipOnError' => true, 'targetClass' => DropdownValues::className(), 'targetAttribute' => ['color' => 'id']],
            [['width'], 'exist', 'skipOnError' => true, 'targetClass' => DropdownValues::className(), 'targetAttribute' => ['width' => 'id']],
            [['size'], 'exist', 'skipOnError' => true, 'targetClass' => DropdownValues::className(), 'targetAttribute' => ['size' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'color' => 'Color',
            'width' => 'Width',
            'size' => 'Size',
            'quantity' => 'Quantity',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor0()
    {
        return $this->hasOne(DropdownValues::className(), ['id' => 'color']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidth0()
    {
        return $this->hasOne(DropdownValues::className(), ['id' => 'width']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSize0()
    {
        return $this->hasOne(DropdownValues::className(), ['id' => 'size']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return CartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CartQuery(get_called_class());
    }

    public static function getCartItemsCount($userid=0){
        if($userid) {
            $query = Cart::find();
            $query->where(['user_id' => $userid]);
            return $query->count();
        }else{
            $session = Yii::$app->session;
            return count($session->get('cart'));
        }
    }
}
