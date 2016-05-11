<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\BillingAddress;
use common\models\ShippingAddress;


class AddressForm extends Widget
{

    public function run()
    {
        $billingModel = new BillingAddress();
        $shippingModel = new ShippingAddress();
        return $this->render('address-form', [
            'billingModel' =>  $billingModel,
            'shippingModel' =>  $shippingModel,
        ]);
    }
}