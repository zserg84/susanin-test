<?php

namespace modules\themes;

use Yii;


class Module extends \yii\base\Module {

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t($category, $message, $params, $language);
    }
}