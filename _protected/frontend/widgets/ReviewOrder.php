<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Cart;
use common\models\Product;
use common\models\VarientProduct;


class ReviewOrder extends Widget
{
    public $order;
    public function run()
    {
        $carts = array();
        $session = Yii::$app->session;

        if (!$session->isActive) {
            // open a session
            $session->open();
        }
        if (!Yii::$app->user->isGuest) {
            if ($session->has('cart')) {
                $carts = $session->get('cart');
                foreach ($carts as $key => $cart) {

                    if (($cartmodel = Cart::find()->where(['varient_id' => $key, 'product_id' => $cart['product_id'], 'user_id' => Yii::$app->user->identity->id])->one()) !== null) {
                        $cartmodel->color = $cart['color'];
                        $cartmodel->size = $cart['size'];
                        $cartmodel->width = $cart['width'];
                        $cartmodel->quantity = $cart['quantity'];
                        if ($cart['quantity'] > 0)
                            $cartmodel->save();
                    } else {
                        $newmodel = new Cart();
                        $newmodel->user_id = Yii::$app->user->identity->id;
                        $newmodel->product_id = $cart['product_id'];
                        $newmodel->varient_id = $key;
                        $newmodel->color = $cart['color'];
                        $newmodel->size = $cart['size'];
                        $newmodel->width = $cart['width'];
                        $newmodel->quantity = $cart['quantity'];
                        if ($cart['quantity'] > 0)
                            $newmodel->save();
                    }
                    unset($carts[$key]);

                }
                $session->set('cart', $carts);
            }

        }


        if (!Yii::$app->user->isGuest) {

            $carts = array();
            $model = new Cart();
            $cartitems = $model->find()->where(['user_id' => Yii::$app->user->identity->id])->all();
            foreach ($cartitems as $cartitem) {
                $carts[$cartitem->varient_id]['product_id'] = $cartitem->product_id;
                $carts[$cartitem->varient_id]['color'] = $cartitem->color;
                $carts[$cartitem->varient_id]['size'] = $cartitem->size;
                $carts[$cartitem->varient_id]['width'] = $cartitem->width;
                $carts[$cartitem->varient_id]['quantity'] = $cartitem->quantity;
            }

        } else {
            if ($session->has('cart')) {
                $carts = $session->get('cart');
            }

        }

        $cart = array();
        $cart['total'] = 0;

        foreach($carts as $key => $cartitem ){
            if (($product = Product::findOne($cartitem['product_id'])) !== null) {
                if (($varient = VarientProduct::findOne($key)) !== null) {
                    if($varient->quantity < 1)
                        continue;

                }else{
                    continue;
                }

                $cart['items'][$key]['name'] = $product->name;
                $cart['items'][$key]['sku'] = $varient->sku;
                $cart['items'][$key]['color'] = $varient->color0->name;
                $cart['items'][$key]['size'] = $varient->size0->name;
                $cart['items'][$key]['product_id'] = $product->id;
                $cart['items'][$key]['quantity'] = $cartitem['quantity'];
                $cart['items'][$key]['singleprice'] = $product->price + $varient->price;
                $cart['items'][$key]['img'] = Yii::$app->params['baseurl'].'/uploads/product/main/'.$product->id.'/custom1/'.$product->productImages->main_image;
                $cart['items'][$key]['width'] = $varient->width0->name;
                $cart['items'][$key]['price'] = ($cartitem['quantity'] * ($product->price + $varient->price));
                $cart['total'] = $cart['total'] + $cart['items'][$key]['price'];
            }else{
                continue;
            }


        }
        return $this->render('review-order',['items'=>$cart
        ,'order'=>$this->order]);
    }
}