<?php

namespace common\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "shipping_address".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $fname
 * @property string $lname
 * @property string $address
 * @property string $email
 * @property integer $phone
 * @property string $company
 * @property integer $city_id
 * @property integer $state_id
 * @property integer $country_id
 * @property integer $zip
 * @property integer $is_shipping
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property Cities $city
 * @property States $state
 * @property Countries $country
 */
class ShippingAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'fname', 'lname', 'address', 'email', 'phone', 'company', 'city_id', 'state_id', 'country_id', 'zip'], 'required'],
            [['user_id', 'phone', 'city_id', 'state_id', 'country_id', 'zip', 'created_at', 'updated_at'], 'integer'],
            [['fname', 'lname'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 250],
            [['email', 'company'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => States::className(), 'targetAttribute' => ['state_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
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
            'fname' => 'Fname',
            'lname' => 'Lname',
            'address' => 'Address',
            'email' => 'Email',
            'phone' => 'Phone',
            'company' => 'Company',
            'city_id' => 'City ID',
            'state_id' => 'State ID',
            'country_id' => 'Country ID',
            'zip' => 'Zip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(States::className(), ['id' => 'state_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    /**
     * @inheritdoc
     * @return ShippingAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShippingAddressQuery(get_called_class());
    }
}
