<?php
namespace frontend\controllers;
use yii\web\Response;
use common\models\Cart;
use common\models\Product;
use common\models\VarientProduct;
use Yii;


class CartController extends FrontendController
{
    public function actionAdd()
    {
		$model = new Cart();
		if($model->load(Yii::$app->request->post()) && $model->validate())
		{
			$session = Yii::$app->session;

			if (!$session->isActive){
				// open a session
				$session->open();
			}
			if ($session->has('cart')) {
				$cart = $session->get('cart');
			}else{
				$cart = array();
			}
			if(Yii::$app->user->isGuest) {
				if($model->varient_id == ''){
					$varient = VarientProduct::find()->where(['product_id'=>$model->product_id,'color'=>$model->color,'width'=>$model->width,'size'=>$model->size])->one();
					$model->varient_id = $varient->id;
				}
				$cart[$model->varient_id]['product_id'] = $model->product_id;
				$cart[$model->varient_id]['color'] = $model->color;
				$cart[$model->varient_id]['size'] = $model->size;
				$cart[$model->varient_id]['width'] = $model->width;
				$cart[$model->varient_id]['quantity'] = $model->quantity;
				$session->set('cart', $cart);
			}else{
				$model->user_id = Yii::$app->user->identity->id;
				$model->save();
			}
			$product = Product::findOne($model->product_id);
			$message = $product->name." has beed added to cart!";
			$result['type'] = 'success';
			$result['message'] = $message;
			Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $result;
		}else{

			$error = \yii\widgets\ActiveForm::validate($model);
				Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $error; 
		}	

    }

}
