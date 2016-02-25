<?php

namespace modules\themes\site;

use yii\web\AssetBundle;

class FileApiImageAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@modules/themes/site/assets';


    public $js = [
        'js/jquery-ui-1.10.4.custom.min.js',
        'js/FileAPI/FileAPI.js',
        'js/event/images.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
