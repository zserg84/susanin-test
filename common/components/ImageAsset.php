<?php

namespace common\components;


use yii\helpers\VarDumper;
use yii\web\AssetBundle;

class ImageAsset extends AssetBundle
{
    public function init()
    {
        parent::init();
        $this->sourcePath = \Yii::getAlias('@statics');
    }

    public static function imgSrc($relativePath,$assetImageDir = 'img' ){
        $obj = new self();
        return \Yii::$app->assetManager->getPublishedUrl($obj->sourcePath)
        . "/" . $assetImageDir . "/" . $relativePath;
    }
} 