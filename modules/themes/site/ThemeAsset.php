<?php

namespace modules\themes\site;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Theme main asset bundle.
 */
class ThemeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@modules/themes/site/assets';

    /**
     * @inheritdoc
     */
    public $css = [
        'css/screen.css',
        'css/typographica.css',
        'css/jquery.formstyler.css',
        'css/font-awesome.css',
        'css/jquery.bxslider.css',
        'css/jqueryui.css',
        'css/jquery.jscrollpane.css',
        'css/media-queries.css',
        'css/pickmeup.css',
        'css/jquery.fancybox.css'
    ];

    public $js = [
        'js/html5shiv.min.js',
        'js/jquery-migrate-1.2.1.min.js',
        'js/placeholders.min.js',
        'js/style.js',
        'js/modernizr-latest.js',
        'js/jquery.formstyler.min.js',
        'js/jquery.bxslider.min.js',
        'js/jqueryui.js',
        'js/jquery.mousewheel.js',
        'js/jquery.jscrollpane.min.js',
        'js/functions.js',
        'js/respond.min.js',
        'js/jquery.pickmeup.min.js',
        'js/modal.js',
        'js/jquery.fancybox.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public static function imgSrc($imageName ){
        $obj = new self();
        \Yii::$app->assetManager->publish($obj->sourcePath. "/images" );
        $dirPath = \Yii::$app->assetManager->getPublishedUrl($obj->sourcePath . "/images");
        $imagePath = $dirPath. "/" . $imageName;

        return $imagePath;
    }

}
