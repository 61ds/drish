<?php
namespace frontend\controllers;
use yii\web\Response;
use common\models\Cart;
use common\models\Product;
use common\models\BillingAddress;
use common\models\ShippingAddress;
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
			if($model->varient_id == ''){
				$varient = VarientProduct::find()->where(['product_id'=>$model->product_id,'color'=>$model->color,'width'=>$model->width,'size'=>$model->size])->one();
				$model->varient_id = $varient->id;
			}
			if(Yii::$app->user->isGuest) {

				$cart[$model->varient_id]['product_id'] = $model->product_id;
				$cart[$model->varient_id]['color'] = $model->color;
				$cart[$model->varient_id]['size'] = $model->size;
				$cart[$model->varient_id]['width'] = $model->width;
				$cart[$model->varient_id]['quantity'] = $model->quantity;
				if($model->quantity > 0)
					$session->set('cart', $cart);
			}else{

				if (($cartmodel = Cart::find()->where(['varient_id'=>$model->varient_id,'product_id'=>$model->product_id,'user_id'=>Yii::$app->user->identity->id])->one()) !== null) {

					$cartmodel->color = $model->color;
					$cartmodel->size = $model->size;
					$cartmodel->width = $model->width;
					$cartmodel->quantity = $model->quantity;
					if($model->quantity > 0)
						$cartmodel->save();
				}else{
					$model->user_id = Yii::$app->user->identity->id;
					if($model->quantity > 0)
						$model->save();
				}

			}
			if(!Yii::$app->user->isGuest) {
				$query = Cart::find();
				$query->where(['user_id' => Yii::$app->user->identity->id]);
				$countitems = $query->count();
			}else{
				$session = Yii::$app->session;
				$countitems = count($session->get('cart'));
			}
			$product = Product::findOne($model->product_id);
			$message = $product->name." has beed added to cart!";
			$result['type'] = 'success';
			$result['message'] = $message;
			$result['count'] = $countitems;
			Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $result;
		}else{

			$error = \yii\widgets\ActiveForm::validate($model);
				Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $error; 
		}	

    }

	public function actionCart()
	{
		$this->layout = 'page';
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
				$cart['items'][$key]['img'] = Yii::$app->params['baseurl'].'/uploads/product/main/'.$product->id.'/custom1/'.$product->productImages[0]->main_image;
				$cart['items'][$key]['width'] = $varient->width0->name;
				$cart['items'][$key]['singleprice'] = $product->price + $varient->price;
				$cart['items'][$key]['price'] = ($cartitem['quantity'] * ($product->price + $varient->price));
				$cart['total'] = $cart['total'] + $cart['items'][$key]['price'];
			}else{
				continue;
			}


		}
		return $this->render('cart',['items'=>$cart
		]);

	}
	public function actionRemove($id)
	{
		$session = Yii::$app->session;

		if(Yii::$app->user->isGuest) {
			if ($session->has('cart')) {
				$cart = $session->get('cart');
				$product_id = $cart[$id]['product_id'];
				unset($cart[$id]);
				$session->set('cart', $cart);
			}
		}else{
			if (($cartmodel = Cart::find()->where(['varient_id'=>$id,'user_id'=>Yii::$app->user->identity->id])->one()) !== null) {
				$product_id = $cartmodel->product_id;
				$cartmodel->delete();
			}
		}
		$product = Product::findOne($product_id);

		$message = $product->name." has beed removed from cart!";

		Yii::$app->getSession()->setFlash('success', Yii::t('app', $message));
		return $this->redirect(['cart/cart']);
	}
	public function actionCheckout()
	{
		$this->layout = 'page';
		return $this->render('checkout');

	}
	public function actionAddress()
	{
		$billingModel = new BillingAddress();
		$shippingModel = new ShippingAddress();

		if (Yii::$app->request->isAjax && $billingModel->load(Yii::$app->request->post())) {
			$billingModel->is_shipping = 1;
			$billingModel->city_id = 1;
			$billingModel->state_id = 13;
			$billingModel->country_id = 101;
			$billingModel->user_id = Yii::$app->user->identity->id;
			if($billingModel->save()){
				$result['type'] = 'success';
				Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $result;
			}else{
				print_r($billingModel->getErrors());die;
				Yii::$app->response->format = Response::FORMAT_JSON;
				echo json_encode(ActiveForm::validate($billingModel));
				Yii::$app->end();
			}

		}



	}
}
