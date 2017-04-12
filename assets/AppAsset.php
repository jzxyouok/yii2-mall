<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $theme = ['Navy','Green','Blue','Red','Orange','Darkgreen'];
   
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public function registerAssetFiles($view){
        $this->css = [
            'css/main.css',
            'css/owl.carousel.css',
            'css/owl.transitions.css',
            'css/animate.min.css',
            'css/config.css',
            'css/'.$this->theme[0].'.css',
            'css/font-awesome.min.css',
            'images/favicon.ico',
        ];
        $this->js = [
            ['js/html5shiv.js','condition'=>'let IE9','position'=>\yii\web\View::POS_HEAD],
            ['js/respond.min.js','condition'=>'let IE9','position'=>\yii\web\View::POS_HEAD],
            'js/jquery-migrate-1.2.1.js',
            'js/gmap3.min.js',
            'js/bootstrap-hover-dropdown.min.js',
            'js/owl.carousel.min.js',
            'js/css_browser_selector.min.js',
            'js/echo.min.js',
            'js/jquery.easing-1.3.min.js',
            'js/bootstrap-slider.min.js',
            'js/jquery.raty.min.js',
            'js/jquery.prettyPhoto.min.js',
            'js/jquery.customSelect.min.js',
            'js/wow.min.js',
            'js/scripts.js'
        ];
        parent::registerAssetFiles($view);
    }

}
