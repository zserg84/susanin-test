<?php

namespace modules\admin;

use Yii;

/**
 * Main backend module.
 */
class Module extends \yii\base\Module
{
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/' . $category, $message, $params, $language);
    }
}
