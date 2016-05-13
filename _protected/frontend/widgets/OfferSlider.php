<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\Product;
use common\models\ProductSearch;
use common\models\ProductForm;
use common\models\Category;
use common\models\Attributes;
use common\models\ProductSliderValues;
use common\models\ProductDropdownValues;
use common\models\ProductImages;
use common\models\DropdownValuesSearch;
use common\models\ProductTextValues;
use common\models\ProductDescValues;
use common\models\ProductPageSetting;

class OfferSlider extends Widget
{
	public $type;
    public function run()
    {
		if($this->type == "men"){
			$prod_ids =ProductPageSetting::find()->where(['category_id' => 2])->one();
			$prods = unserialize($prod_ids->product_slides);
			foreach($prods as $prod_id){
				$id = $prod_id;
				$prod = Product::find()->where(['id'=>$id])->one();
				if($prod){
					$prod_model[] = $prod;
				}
			}
		}else if($this->type == "women"){
			$prod_id =ProductPageSetting::find()->where(['category_id' => 3])->one();
			$prods = unserialize($prod_ids->product_slides);
			foreach($prods as $prod_id){
				$id = $prod_id;
				$prod = Product::find()->where(['id'=>$id])->one();
				if($prod){
					$prod_model[] = $prod;
				}
			}
		}else if($this->type == "kids"){
			$prod_id =ProductPageSetting::find()->where(['category_id' => 1])->one();
			$prods = unserialize($prod_ids->product_slides);
			foreach($prods as $prod_id){
				$id = $prod_id;
				$prod = Product::find()->where(['id'=>$id])->one();
				if($prod){
					$prod_model[] = $prod;
				}
			}
		}
		
        if($prod_model) {
            return $this->render('offer-slider', [
                'product_ids' => $prod_model,
            ]);
        }
    }

}