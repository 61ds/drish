<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "varient_product".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $sku
 * @property integer $color
 * @property integer $size
 * @property integer $width
 * @property integer $price
 * @property integer $status
 *
 * @property Product[] $products
 * @property Product $product
 * @property DropdownValues $color0
 * @property DropdownValues $size0
 * @property DropdownValues $width0
 */
class VarientProduct extends \yii\db\ActiveRecord
{
    public $colors;
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
            [['product_id', 'sku', 'color', 'size', 'width', 'price'], 'required'],
            [['product_id', 'color', 'size', 'width', 'price', 'status'], 'integer'],
            [['sku'], 'string', 'max' => 255],
            [['colors'], 'safe'],
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
            'sku' => 'Sku',
            'color' => 'Color',
            'size' => 'Size',
            'width' => 'Width',
            'price' => 'Price',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['varient_id' => 'id']);
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
    public function getAllcolor()
    {
        $attr = Attributes::find()->where(['name' => 'color'])->one();
        $attrvalues = array();
        if($attr){
            $attrvalues = DropdownValues::find()->where(['attribute_id' => $attr->id])->orderBy('name')->all();
        }
        return ArrayHelper::map($attrvalues,'id','name');
    }
}
