<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_page_setting".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $video
 * @property string $product_slides
 * @property string $name
 *
 * @property Category $category
 */
class ProductPageSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_page_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id','name'], 'required'],
            [['category_id'], 'integer'],
            [['video', 'name'], 'string', 'max' => 255],
            [['product_slides'], 'string', 'max' => 2550],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'video' => 'Video',
            'product_slides' => 'Product Slides',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
