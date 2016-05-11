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

class ProductsSlider extends Widget
{
	public $type;
    public function run()
    {
		if($this->type == "men"){
			$prods = Product::find()->where(["status" => 1])->orderBy(["id"=> SORT_DESC ])->all();
			foreach($prods as $prod){
				$cats = Category::find()->where(['root' => 2,"id"=>$prod->category_id])->one();
				if($cats){
					$prod_model[] = $prod;
				}
			}
		}else if($this->type == "women"){
			$prods = Product::find()->where(["status" => 1])->orderBy(["id"=> SORT_DESC ])->all();
			foreach($prods as $prod){
				$cats = Category::find()->where(['root' => 3,"id"=>$prod->category_id])->one();
				if($cats){
					$prod_model[] = $prod;
				}
			}
		}else if($this->type == "kids"){
			$prods = Product::find()->where(["status" => 1])->orderBy(["id"=> SORT_DESC ])->all();
			foreach($prods as $prod){
				$cats = Category::find()->where(['root' => 1,"id"=>$prod->category_id])->one();
				if($cats){
					$prod_model[] = $prod;
				}
			}
		}
		
		
        if($prod_model) {
            return $this->render('product-slider', [
                'product_ids' => $prod_model,
            ]);
        }
    }

}