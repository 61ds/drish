<?php
namespace frontend\widgets;use Yii;
use yii\base\Widget;
use yii\helpers\Html;use common\models\SliderImages;class SliderWid extends Widget{	public $slider_id;	public $position;	public $imggallery;	public function run()	{				$slides = SliderImages::find()->where(['slider_id' => $this->slider_id])->all();		return $this->render('sliderwid', [			'slider_id' =>  $this->slider_id,			'slides' =>  $slides,			'position' =>  $this->position,
        ]);	
		
	}
}