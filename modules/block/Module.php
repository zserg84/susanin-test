<?php

namespace modules\block;

use modules\translations\components\DbMessageSource;
use modules\translations\models\Lang;
use Yii;
use yii\helpers\VarDumper;

/**
 * Module [[Users]]
 * Yii2 users module.
 */
class Module extends \common\components\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'modules\block\controllers\frontend';

    public static $name = 'block';
}
