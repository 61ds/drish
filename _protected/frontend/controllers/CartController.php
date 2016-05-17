<?php
namespace frontend\controllers;
use common\models\GuestUser;
use common\models\OrderItems;
use common\models\User;
use frontend\models\SignupForm;
use yii\web\Response;
use common\models\Cart;
use common\models\Product;
use common\models\Orders;
use common\models\BillingAddress;
use common\models\ShippingAddress;
use common\models\VarientProduct;
use Yii;
use common\rbac\helpers\RbacHelper;
use nenad\passwordStrength\StrengthValidator;

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
			$carts = array();
			$model = new Cart();
			$cartitems = $model->find()->where(['user_id' => Yii::$app->user->identity->id])->all();
			foreach ($cartitems as $cartitem) {
				$carts[$cartitem->varient_id]['product_id'] = $cartitem->product_id;
				$carts[$cartitem->varient_id]['color'] = $cartitem->color;
				$carts[$cartitem->varient_id]['size'] = $cartitem->size;
				$carts[$cartitem->varient_id]['width'] = $cartitem->width;
				$carts[$cartitem->varient_id]['quantity'] = $cartitem->quantity;
				$carts[$cartitem->varient_id]['id'] = $cartitem->id;
			}
		} else {
			if ($session->has('cart')) {
				$carts = $session->get('cart');
			}

		}

		$cart = array();
		$cart['total'] = 0;
		if(isset($carts)) {
			foreach ($carts as $key => $cartitem) {
				if (($product = Product::findOne($cartitem['product_id'])) !== null) {
					if (($varient = VarientProduct::findOne($key)) !== null) {
						if ($varient->quantity < 1)
							continue;

					} else {
						continue;
					}

					$cart['items'][$key]['name'] = $product->name;
					$cart['items'][$key]['sku'] = $varient->sku;
					$cart['items'][$key]['color'] = $varient->color0->name;
					$cart['items'][$key]['size'] = $varient->size0->name;
					$cart['items'][$key]['product_id'] = $product->id;
					$cart['items'][$key]['quantity'] = $cartitem['quantity'];
					$cart['items'][$key]['img'] = Yii::$app->params['baseurl'] . '/uploads/product/main/' . $product->id . '/custom1/' . $product->productImages->main_image;
					$cart['items'][$key]['width'] = $varient->width0->name;
					$cart['items'][$key]['singleprice'] = $product->price + $varient->price;
					$cart['items'][$key]['price'] = ($cartitem['quantity'] * ($product->price + $varient->price));
					$cart['total'] = $cart['total'] + $cart['items'][$key]['price'];
				} else {
					continue;
				}


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
		if(Yii::$app->user->isGuest){
			$userid = 0;
		}else{
			$userid = Yii::$app->user->identity->id;
		}
		$result = Cart::getCartItemsCount($userid);
		if($result){
			$order = new Orders();
			$order->payment_method = 1;
			return $this->render('checkout',['order'=> $order]);
		}else{
			return $this->redirect(['cart/cart']);
		}



	}
	public function actionAddress()
	{
		$session = Yii::$app->session;
		if(Yii::$app->user->isGuest){
			$userid = 0;
		}else{
			$userid = Yii::$app->user->identity->id;
		}
		$result = Cart::getCartItemsCount($userid);
		if($result == 0){
			return $this->redirect(['cart/cart']);
		}
		if (!Yii::$app->user->isGuest) {
			$billingModel = BillingAddress::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
			$shippingModel = ShippingAddress::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
			if(!$billingModel)
				$billingModel = new BillingAddress();

			if(!$shippingModel)
				$shippingModel = new ShippingAddress();
		}else{
			$billingModel = new BillingAddress();
			$shippingModel = new ShippingAddress();

		}

		if (Yii::$app->request->isPost && Yii::$app->request->isAjax && $billingModel->load(Yii::$app->request->post()) ) {

			$billingModel->city_id = 1;
			$billingModel->state_id = 13;
			$billingModel->country_id = 101;


			if(Yii::$app->user->isGuest) {
				if (!empty($_SERVER['HTTP_CLIENT_IP']))
				{
					$ip=$_SERVER['HTTP_CLIENT_IP'];
				}
				elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
				{
					$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
				}
				else
				{
					$ip=$_SERVER['REMOTE_ADDR'];
				}

				$guestModel = GuestUser::find()->where(['email'=>$billingModel->email,'ip'=>$ip])->one();
				if(!$guestModel)
					$guestModel = new GuestUser();

				$guestModel->load(Yii::$app->request->post());

				if ($guestModel->new_account == 1) {
					if (!$session->has('userid')) {
						$userModel = new User();

						$userModel->username = $billingModel->email;
						$userModel->email = $billingModel->email;
						$userModel->status = 10;
						$userModel->setPassword($guestModel->password);
						$userModel->generateAuthKey();
						$rna = Yii::$app->params['rna'];
						// if scenario is "rna" we will generate account activation token
						if ($rna) {
							$userModel->generateAccountActivationToken();
						}


						if ($userModel->save() && RbacHelper::assignRole($userModel->getId()) ? $userModel : null) {


						} else {
							Yii::$app->response->format = Response::FORMAT_JSON;
							echo json_encode($userModel->getErrors());
							Yii::$app->end();
						}

						$guestid = $userModel->id;

						$session->set('userid', $guestid);
						$session->remove('guestid');
						$billingModel->user_id = $guestid;
						$shippingModel->user_id = $guestid;
					}else{
						$guestid = $session->get('userid');
						$billingModel->user_id = $guestid;
						$shippingModel->user_id = $guestid;

					}


				} else {

					$guestModel->fname = $billingModel->fname;
					$guestModel->lname = $billingModel->lname;
					$guestModel->email = $billingModel->email;
					$guestModel->phone = $billingModel->phone;
					$guestModel->password = $billingModel->phone;
					$guestModel->ip = $ip;
					if (!$guestModel->save()) {
						print_r($guestModel->getErrors());
						print_r($billingModel->getErrors());
						print_r($shippingModel->getErrors());
						die;
						Yii::$app->response->format = Response::FORMAT_JSON;
						echo json_encode(ActiveForm::validate($billingModel));
						Yii::$app->end();
					}

					$guestid = $guestModel->id;
					$session = Yii::$app->session;
					$session->set('guestid',$guestid);
					$billingModel->guest_id = $guestid;
					$shippingModel->guest_id = $guestid;

				}

			}else{
				$userid = Yii::$app->user->identity->id;
				$billingModel->user_id = $userid;
				$shippingModel->user_id = $userid;
			}

			if($billingModel->is_shipping != 1){
				$shippingModel->fname = $billingModel->fname;
				$shippingModel->lname = $billingModel->lname;
				$shippingModel->address = $billingModel->address;
				$shippingModel->email = $billingModel->email;
				$shippingModel->phone = $billingModel->phone;
				$shippingModel->company = $billingModel->company;
				$shippingModel->zip = $billingModel->zip;
				$shippingModel->city_id = $billingModel->city_id;
				$shippingModel->state_id = $billingModel->state_id;
				$shippingModel->country_id = $billingModel->country_id;

			}else{
				$shippingModel->load(Yii::$app->request->post());
				$shippingModel->city_id = $billingModel->city_id;
				$shippingModel->state_id = $billingModel->state_id;
				$shippingModel->country_id = $billingModel->country_id;
			}



			if($billingModel->save() && $shippingModel->save()){
				$result = array();
				$result['type'] = 'success';
				Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $result;
			}else{
				print_r($billingModel->getErrors());   print_r($shippingModel->getErrors()); die;
				Yii::$app->response->format = Response::FORMAT_JSON;
				echo json_encode(ActiveForm::validate($billingModel));
				Yii::$app->end();
			}

		}

	}
	public function actionPlaceOrder($orderid=0)
	{
		if(Yii::$app->user->isGuest){
			$userid = 0;
		}else{
			$userid = Yii::$app->user->identity->id;
		}
		$result = Cart::getCartItemsCount($userid);
		if($result == 0 && $orderid == 0){
			return $this->redirect(['cart/cart']);
		}

		$this->layout = 'page';

			$orders = new Orders();
			if (Yii::$app->request->isPost && Yii::$app->request->isAjax && $orders->load(Yii::$app->request->post()) ) {

				if($orders->payment_method == ''){
					$orders->payment_method = 1;
				}


				$session = Yii::$app->session;

				if (!$session->isActive) {
					// open a session
					$session->open();
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
						$carts[$cartitem->varient_id]['id'] = $cartitem->id;
					}
				} else {
					if ($session->has('cart')) {
						$carts = $session->get('cart');
					}

				}

				$cart = array();
				$cart['total'] = 0;
				if(isset($carts)) {
					foreach ($carts as $key => $cartitem) {

						if (($product = Product::findOne($cartitem['product_id'])) !== null) {
							if (($varient = VarientProduct::findOne($key)) !== null) {
								if ($varient->quantity < 1)
									continue;

							} else {
								continue;
							}

							$cart['items'][$key]['name'] = $product->name;
							if(isset($cartitem['id']))
								$cart['items'][$key]['id'] = $cartitem['id'];
							$cart['items'][$key]['sku'] = $varient->sku;
							$cart['items'][$key]['color'] = $varient->color0->name;
							$cart['items'][$key]['size'] = $varient->size0->name;
							$cart['items'][$key]['product_id'] = $product->id;
							$cart['items'][$key]['quantity'] = $cartitem['quantity'];
							$cart['items'][$key]['img'] = Yii::$app->params['baseurl'] . '/uploads/product/main/' . $product->id . '/custom1/' . $product->productImages->main_image;
							$cart['items'][$key]['width'] = $varient->width0->name;
							$cart['items'][$key]['singleprice'] = floatval($product->price + $varient->price);
							$cart['items'][$key]['price'] = floatval($cartitem['quantity'] * ($product->price + $varient->price));
							$cart['total'] = floatval($cart['total'] + $cart['items'][$key]['price']);
						} else {
							continue;
						}


					}
				}


				if (!Yii::$app->user->isGuest) {
					$orders->user_id = Yii::$app->user->identity->id;
				}else{
					if( $session->get('guestid') != '')
						$orders->guest_id = $session->get('guestid');
					if( $session->get('userid') != '')
						$orders->user_id = $session->get('userid');
				}
				$orders->items_count = count($cart);
				$orders->price_total = floatval($cart['total']);
				$orders->delivery_charges = 0;
				$orders->grand_total = floatval($cart['total'] + $orders->delivery_charges);
				$orders->status = 1;
				$orders->locked = 0;
				$orders->payment_status = 1;



				if($orders->save()){
					foreach($cart['items'] as $key => $item){
						$itemModel = new OrderItems();
						$itemModel->order_id = $orders->id;
						$itemModel->product_id = $item['product_id'];
						$itemModel->varient_id = $key;
						$itemModel->quantity = $item['quantity'];
						$itemModel->rate = floatval($item['singleprice']);
						$itemModel->defaultrate = floatval($item['singleprice']);
						$itemModel->total = floatval($item['price']);

						if($itemModel->save()){
							if (!Yii::$app->user->isGuest) {
								if (isset($item['id']) && ($cartModel = Cart::findOne($item['id'])) !== null) {
									$cartModel->delete();
								}
							}else{
								if ($session->has('cart')) {
									$data = $session->get('cart');
									unset($data[$key]);
									$session->set('cart',$data);
								}
							}
						}

					}

					return $this->redirect(['cart/place-order','orderid'=>$orders->id]);
				}else{

					Yii::$app->response->format = Response::FORMAT_JSON;
					echo json_encode(ActiveForm::validate($orders));
					Yii::$app->end();
				}
			}else{

				return $this->render('place-order',['orderid'=>$orderid]);
			}


	}
}
