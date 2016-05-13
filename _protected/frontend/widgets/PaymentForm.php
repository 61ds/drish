<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;



class PaymentForm extends Widget
{

    public function run()
    {

        return $this->render('payment-form');
    }
}