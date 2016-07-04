<?php
/**
 * -----------------------------------------------------------------------------
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * -----------------------------------------------------------------------------
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

// set @themes alias so we do not have to update baseUrl every time we change themes
Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

/**
 * -----------------------------------------------------------------------------
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 * -----------------------------------------------------------------------------
 */
class InnerTwoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'css1/fonts.css',
        'css/bootstrap.min.css',
        'css1/jquery.bxslider.css',
        'css1/style.css',
        'css1/font-awesome.css',
        'css1/responsive.css',
        'css1/flaticon.css',
        'css1/demo.css',
        'css1/jquery.mmenu.all.css',
    ];
    public $js = [

        'js/jquery.bxslider.min.js',
        'js/custom.js',
        'js/modernizr.custom.js',
        'js/toucheffects.js',
        'js/bootstrap.min.js',
        'js/jquery.mmenu.all.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}

