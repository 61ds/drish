<?php
namespace frontend\controllers;

use common\models\User;
use common\models\LoginForm;
use common\models\VarientProduct;
use frontend\models\AccountActivation;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Product;
use common\models\Cart;
use common\models\ProductImages;
use common\models\ProductDropdownValues;
use common\models\ProductTextValues;
use common\models\ProductDescValues;
use common\models\DropdownValues;
use common\models\Attributes;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use Yii;
/**
 * Site controller.
 * It is responsible for displaying static pages, logging users in and out,
 * sign up and account activation, password reset.
 */
class MenController extends Controller
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
		$this->layout = "inner";
        return $this->render('index');
    }

    public function actionProduct($id){
        $this->layout = "products";
        $ProductDropdownValues = ProductDropdownValues::find()->where(['product_id' => $id])->all();
        $ProductDescValues = ProductDescValues::find()->where(['product_id' => $id])->all();
        $ProductTextValues = ProductTextValues::find()->where(['product_id' => $id])->all();
        $ProductImages = ProductImages::find()->where(['product_id' => $id])->all();
        $DropdownValues = new DropdownValues;
        $cart = new Cart();
        $varientModel = new VarientProduct();


        if (($model = Product::findOne($id)) !== null) {
            $searchvarient = VarientProduct::find()->where(['product_id'=>$id])->all();
            $varients = array();
            $i = 0;
            foreach($searchvarient as $varient){
                $varients[$i]['color'] = $varient->color;
                $varients[$i]['size'] = $varient->size;
                $varients[$i]['width'] = $varient->width;
                $varients[$i]['price'] = $varient->price + $model->price;
                $varients[$i]['quantity'] = $varient->quantity + $model->quantity;
                $i++;
            }

            return $this->render('product',['model'=>$model,
                'productDropdownValues'=>$ProductDropdownValues,
                'productDescValues'=>$ProductDescValues,
                'productTextValues'=>$ProductTextValues,
                'productImages'=>$ProductImages,
                'dropdownValues'=>$DropdownValues,
                'varientModel'=>$varientModel,
                'cart'=>$cart,
                'varients'=>$varients,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }
}
