<?php

namespace common\config;

use Yii;
use yii\base\BootstrapInterface;
use common\models\SettingAttributes;
/*
/* The base class that you use to retrieve the settings from the database
*/

class settings implements BootstrapInterface {

    private $db;

    public function __construct() {
        $this->db = Yii::$app->db;
    }

    /**
    * Bootstrap method to be called during application bootstrap stage.
    * Loads all the settings into the Yii::$app->params array
    * @param Application $app the application currently running
    */

    public function bootstrap($app) {
		$setting_model = new SettingAttributes();
		$set_id = array(1,2,3,4);
		foreach($set_id as $set_id1){
			$setting_models = $setting_model->getSiteInfo($set_id1);
			
			foreach ($setting_models as $key => $val) {
				Yii::$app->params['settings'][$key] = $val;
			}				
		}
		Yii::$app->params['adminEmail'] = Yii::$app->params['settings']['admin_mail'];
		Yii::$app->params['siteName'] = Yii::$app->params['settings']['site_meta_title'];


		
		//thumb,medium,large image path
		Yii::$app->params['uploadThumbs'] = 'thumbs';
		Yii::$app->params['uploadLarge'] = 'large';
		Yii::$app->params['uploadMedium'] = 'medium';
		Yii::$app->params['uploadMain'] = 'main';
		
		
		Yii::$app->params['baseurl'] = str_replace('/backend','',\Yii::$app->request->baseUrl);
		Yii::$app->params['uploadurl'] = str_replace('/backend','',Yii::getAlias('@webroot'));
		
		Yii::$app->params['folders']['name'] = array('uploadMain','uploadLarge','uploadThumbs','uploadMedium');
		Yii::$app->params['folders']['size'] = array('uploadMain'=>'','uploadLarge'=>'800','uploadThumbs'=>'150','uploadMedium'=>'500');
    }

}