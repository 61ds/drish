<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property integer $quantity
 * @property integer $price
 * @property integer $market_price
 * @property string $descr
 * @property string $short_descr
 * @property integer $status
 * @property integer $soldout
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $featured_image;
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'quantity', 'price', 'market_price', 'descr', 'short_descr'], 'required'],
            [['category_id', 'quantity', 'price', 'market_price', 'status', 'soldout', 'created_at', 'updated_at'], 'integer'],
            [['descr', 'short_descr', 'meta_description'], 'string'],
            [['name','sku','article_id'], 'string', 'max' => 110],
            [['meta_title', 'meta_keyword'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'name' => 'Name',
            'category_id' => 'Category',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'market_price' => 'Market Price',
            'descr' => 'Description',
            'short_descr' => 'Short Description',
            'status' => 'Status',
            'soldout' => 'Soldout',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keyword' => 'Meta Keyword',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    public function getCategories(){
        $cat = Category::find()->where(['status' => 1])->orderBy('name')->all();
        return ArrayHelper::map($cat,'id','name');
    }
}
