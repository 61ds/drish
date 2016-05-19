<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;



class Discountform extends Widget
{
    public function run()
    {
        $model = new \frontend\models\DiscountForm();
        return $this->render('discount-form', [
            'model' =>  $model,
        ]);
    }
}