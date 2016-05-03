<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "varient_product".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $color
 * @property integer $size
 * @property integer $width
 * @property integer $price_type
 * @property integer $price
 * @property integer $status
 *
 * @property Product $product
 * @property DropdownValues $color0
 * @property DropdownValues $size0
 * @property DropdownValues $width0
 */
class VarientProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'varient_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'color', 'size', 'width', 'price'], 'required'],
            [['product_id', 'color', 'size', 'width', 'price_type', 'price', 'status'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['color'], 'exist', 'skipOnError' => true, 'targetClass' => DropdownValues::className(), 'targetAttribute' => ['color' => 'id']],
            [['size'], 'exist', 'skipOnError' => true, 'targetClass' => DropdownValues::className(), 'targetAttribute' => ['size' => 'id']],
            [['width'], 'exist', 'skipOnError' => true, 'targetClass' => DropdownValues::className(), 'targetAttribute' => ['width' => 'id']],
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
            'color' => 'Color',
            'size' => 'Size',
            'width' => 'Width',
            'price_type' => 'Price Type',
            'price' => 'Price',
            'status' => 'Status',
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
    public function getSize0()
    {
        return $this->hasOne(DropdownValues::className(), ['id' => 'size']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidth0()
    {
        return $this->hasOne(DropdownValues::className(), ['id' => 'width']);
    }

    /**
     * @inheritdoc
     * @return VarientProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VarientProductQuery(get_called_class());
    }
}
