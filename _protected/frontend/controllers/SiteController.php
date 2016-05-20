<?php
namespace frontend\controllers;

use common\models\User;
use common\models\LoginForm;
use common\models\Pages;
use common\models\Newsletter;
use common\models\Product;
use common\models\Cart;
use common\models\ProductImages;
use common\models\ProductPageSetting;
use common\models\ProductDropdownValues;
use common\models\Category;
use common\models\ProductTextValues;
use common\models\ProductDescValues;
use common\models\DropdownValues;
use common\models\Attributes;
use frontend\models\AccountActivation;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\web\Response;
/**
 * Site controller.
 * It is responsible for displaying static pages, logging users in and out,
 * sign up and account activation, password reset.
 */
class SiteController extends Controller
{
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Declares external actions for the controller.
     *
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

//------------------------------------------------------------------------------------------------//
// STATIC PAGES
//------------------------------------------------------------------------------------------------//

    /**
     * Displays the index (home) page.
     * Use it in case your home page contains static content.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays the about static page.
     *
     * @return string
     */ 
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays the contact static page and sends the contact email.
     *
     * @return string|\yii\web\Response
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if ($model->contact(Yii::$app->params['adminEmail'])) 
            {
                Yii::$app->session->setFlash('success', 
                    'Thank you for contacting us. We will respond to you as soon as possible.');
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } 
        
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

//------------------------------------------------------------------------------------------------//
// LOG IN / LOG OUT / PASSWORD RESET
//------------------------------------------------------------------------------------------------//

    /**
     * Logs in the user if his account is activated,
     * if not, displays appropriate message.
     *
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = "products";
        // get setting value for 'Login With Email'
        $lwe = Yii::$app->params['lwe'];

        // if 'lwe' value is 'true' we instantiate LoginForm in 'lwe' scenario
        $model = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();

        // now we can try to log in the user
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if( $model->login()){
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
                return $this->goBack();
            } // user couldn't be logged in, because he has not activated his account
            elseif ($model->notActivated()) {
                // if his account is not activated, he will have to activate it first
                Yii::$app->session->setFlash('error',
                    'You have to activate your account first. Please check your email.');

                return $this->refresh();
            } // account is activated, but some other errors have happened
            else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                echo json_encode(\yii\widgets\ActiveForm::validate($model));
                Yii::$app->end();
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the user.
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

/*----------------*
 * PASSWORD RESET *
 *----------------*/

    /**
     * Sends email that contains link for password reset action.
     *
     * @return string|\yii\web\Response
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if ($model->sendEmail()) 
            {
                Yii::$app->session->setFlash('success', 
                    'Check your email for further instructions.');

                return $this->goHome();
            } 
            else 
            {
                Yii::$app->session->setFlash('error', 
                    'Sorry, we are unable to reset password for email provided.');
            }
        }
        else
        {
            return $this->render('requestPasswordResetToken', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Resets password.
     *
     * @param  string $token Password reset token.
     * @return string|\yii\web\Response
     *
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try 
        {
            $model = new ResetPasswordForm($token);
        } 
        catch (InvalidParamException $e) 
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) 
            && $model->validate() && $model->resetPassword()) 
        {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }
        else
        {
            return $this->render('resetPassword', [
                'model' => $model,
            ]);
        }       
    }    

//------------------------------------------------------------------------------------------------//
// SIGN UP / ACCOUNT ACTIVATION
//------------------------------------------------------------------------------------------------//

    /**
     * Signs up the user.
     * If user need to activate his account via email, we will display him
     * message with instructions and send him account activation email
     * ( with link containing account activation token ). If activation is not
     * necessary, we will log him in right after sign up process is complete.
     * NOTE: You can decide whether or not activation is necessary,
     * @see config/params.php
     *
     * @return string|\yii\web\Response
     */


    public function actionSignup()
    {
        // get setting value for 'Registration Needs Activation'
        $rna = Yii::$app->params['rna'];

        // if 'rna' value is 'true', we instantiate SignupForm in 'rna' scenario
        $model = $rna ? new SignupForm(['scenario' => 'rna']) : new SignupForm();


        // collect and validate user data
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            $model->status =10;
            // try to save user data in database
            if ($user = $model->signup())
            {

                // if user is active he will be logged in automatically ( this will be first user )
                if ($user->status === User::STATUS_ACTIVE)
                {
                    if (Yii::$app->getUser()->login($user))
                    {
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
                        return $this->goHome();
                    }
                }
                // activation is needed, use signupWithActivation()
                else
                {
                    $this->signupWithActivation($model, $user);

                    return $this->refresh();
                }
            }
            // user could not be saved in database
            else
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                echo json_encode(\yii\widgets\ActiveForm::validate($model));
                Yii::$app->end();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /**
     * Sign up user with activation.
     * User will have to activate his account using activation link that we will
     * send him via email.
     *
     * @param $model
     * @param $user
     */
    private function signupWithActivation($model, $user)
    {
        // try to send account activation email
        if ($model->sendAccountActivationEmail($user)) 
        {
            Yii::$app->session->setFlash('success', 
                'Hello '.Html::encode($user->username).'. 
                To be able to log in, you need to confirm your registration. 
                Please check your email, we have sent you a message.');
        }
        // email could not be sent
        else 
        {
            // display error message to user
            Yii::$app->session->setFlash('error', 
                "We couldn't send you account activation email, please contact us.");

            // log this error, so we can debug possible problem easier.
            Yii::error('Signup failed! 
                User '.Html::encode($user->username).' could not sign up.
                Possible causes: verification email could not be sent.');
        }
    }

/*--------------------*
 * ACCOUNT ACTIVATION *
 *--------------------*/

    /**
     * Activates the user account so he can log in into system.
     *
     * @param  string $token
     * @return \yii\web\Response
     *
     * @throws BadRequestHttpException
     */
    public function actionActivateAccount($token)
    {
        try 
        {
            $user = new AccountActivation($token);
        } 
        catch (InvalidParamException $e) 
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user->activateAccount()) 
        {
            Yii::$app->session->setFlash('success', 
                'Success! You can now log in. 
                Thank you '.Html::encode($user->username).' for joining us!');
        }
        else
        {
            Yii::$app->session->setFlash('error', 
                ''.Html::encode($user->username).' your account could not be activated, 
                please contact us!');
        }

        return $this->redirect('login');
    }
	public function actionPage($slug){
		$this->layout="page";
		$page = Pages::find()->where(['slug' =>$slug ])->one();
		return $this->render('page', [
                'model' => $page,
            ]);
	}
	public function actionCategory($slug,$main=0,$submain = 0){
		$this->layout="category";
		
		if($main){
			$parent_main = Category::find()->where(['slug' =>$main ])->one();
			$cat = Category::find()->where(['slug' =>$slug,'root' => $parent_main->id])->one();
			/* $cat_childs = $parent_main->children(1)->all();
			foreach($cat_childs as $cat_child){
				if( $cat_child->id == $cat->id ){
					
				}
			} */
			if($submain){
				$parent_submain = Category::find()->where(['slug' =>$submain ])->one();
			}
		}else{
			$cat = Category::find()->where(['slug' =>$slug])->one();	
		} 
		
		$products = array();
		$productimage = new ProductImages;
		if($cat){
		$cat_child = $cat->children(1)->all();
		
		$products1 = Product::find()->where(['category_id' => $cat->id])->limit(20)->orderBy(['updated_at' => SORT_DESC, ])->all();
		
		if($products1){
			$products[] = $products1;
		}
		if($cat_child){
			foreach($cat_child as $cat_sub_child){
				$cat_subchild = $cat_sub_child->children(1)->all();
				$products2 = Product::find()->where(['category_id' => $cat_sub_child->id])->limit(20)->orderBy(['updated_at' => SORT_DESC, ])->all();
				if($products2){
					$products[] = $products2;
				}
				if($cat_subchild){
					foreach($cat_subchild as $cat_subchild1){
						$cat_subchilds = $cat_subchild1->children(1)->all();
						$products3 = Product::find()->where(['category_id' => $cat_subchild1->id])->limit(20)->orderBy(['updated_at' => SORT_DESC, ])->all();
						if($products3){
							$products[] = $products3;
						}
						if($cat_subchilds){
							foreach($cat_subchilds as $cat_subchilds1){
							$products4 = Product::find()->where(['category_id' => $cat_subchilds1->id])->limit(20)->orderBy(['updated_at' => SORT_DESC, ])->all();
							if($products4){
									$products[] = $products4;
								}
							}
						}
					}
				}
			}
		}
		}
		return $this->render('category', [
           'products' => $products,
           'productimage' => $productimage,
           'category' => $cat,
           'main' => $main,
           'submain' => $submain,
           'slug' => $slug,
        ]);
	}
	public function actionNewsletter()
	{	
		$model = new Newsletter;
		if($model->load(Yii::$app->request->post()))
		{
			$model->status = 0;
			$model->save();
			$result = 'success';
			Yii::$app->response->format = trim(Response::FORMAT_JSON);
			return $result;
		}else{
			$error = \yii\widgets\ActiveForm::validate($model);
			Yii::$app->response->format = trim(Response::FORMAT_JSON);
			return $error; 
		}		
 
	}
}
