<?php
namespace frontend\controllers;
use yii\helpers\Url;
use common\models\User;
use common\models\LoginForm;
use common\models\Pages;
use common\models\Newsletter;
use common\models\Product;
use common\models\Profile;
use common\models\Cart;
use common\models\VarientProduct;
use common\models\Review;
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
use frontend\models\SearchForm;
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
class AccountController extends Controller
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

	public function actionWishlist()
	{
		$model =  new Profile();

        // collect and validate user data
        if (Yii::$app->request->isAjax )
        {
			if(Yii::$app->user->isGuest){
				$result = "Please Login First";
				$label = "Please Login First";
				$enabled = "false";
				$success = true;
				return $result;
			}else{
				$id = Yii::$app->request->post('prodid');
				$data = $model->find()->where(['user_id' => Yii::$app->user->identity->id])->one();
				$id_array = array();
				if($data){
					$ids = unserialize($data->wishlist);
					if($ids){
						if (!in_array($id, $ids)) {
							$ids[] = $id;
							$data->wishlist = serialize($ids);
							$data->save();
							$result = "Product is added to your wishlist";
							$label = "Remove from Wishlist";
							$enabled = "false";
							$success = true;
							return $result;
						} else {
							$result = "This Product is already added to your wishlist";
							$label = "Remove from Wishlist";
							$enabled = "false";
							$success = false;
							return $result;
						}
						$data->save();
						$result = 'success';
						Yii::$app->response->format = trim(Response::FORMAT_JSON);
						return $result;
					}else{
						$id_array[] = $id;
						$id_wish = serialize($id_array);
						$data->wishlist = $id_wish;
						$data->save();
						$result = 'success';
						Yii::$app->response->format = trim(Response::FORMAT_JSON);
						return $result;
					}
				}
			}
		}
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
	public function actionReview()
    {

        // if 'rna' value is 'true', we instantiate SignupForm in 'rna' scenario
        $model =  new Review();

        // collect and validate user data
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
			$data = $model->find()->where(['user_id' => $model->user_id, 'product_id' => $model->product_id ])->one();
			if($data){
				if($data->save()){
					$result = 'success';
					Yii::$app->response->format = trim(Response::FORMAT_JSON);
					return $result;
				}
				// user could not be saved in database
				else
				{
					Yii::$app->response->format = Response::FORMAT_JSON;
					echo json_encode(\yii\widgets\ActiveForm::validate($model));
					Yii::$app->end();
				}
			}else{
				if($model->save()){
					$result = 'success';
					Yii::$app->response->format = trim(Response::FORMAT_JSON);
					return $result;
				}
				// user could not be saved in database
				else
				{
					Yii::$app->response->format = Response::FORMAT_JSON;
					echo json_encode(\yii\widgets\ActiveForm::validate($model));
					Yii::$app->end();
				}
			}
			
        }

        return $this->render('/site/signup', [
            'model' => $model,
        ]);
    }
}
