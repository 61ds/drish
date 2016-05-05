<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;

class RelatedProducts extends Widget
{
    public $related_products;
    public function run()
    {
print_r($this->related_products);
        die;
        return $this->render('related-product', [
            'products' =>  $this->related_products,
        ]);



    }

}