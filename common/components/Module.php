<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 23.02.16
 * Time: 14:20
 */

namespace common\components;

use yii\base\InvalidConfigException;

class Module extends \yii\base\Module
{
    /**
     * @var boolean Whether module is used for backend or not
     */
    public $isBackend = false;

    /**
     * @var string|null Module name
     */
    public static $name;


    /**
     * @inheritdoc
     */
    public function init()
    {
        if (static::$name === null) {
            throw new InvalidConfigException('The "name" property must be set.');
        }

        if ($this->isBackend === true) {
            $this->setViewPath('@modules/' . static::$name . '/views/backend');
            if ($this->controllerNamespace === null) {
                $this->controllerNamespace =  'modules' . '\\' . static::$name . '\controllers\backend';
            }
        } else {
            $this->setViewPath('@modules/' . static::$name . '/views/frontend');
            if ($this->controllerNamespace === null) {
                $this->controllerNamespace = 'modules' . '\\' . static::$name . '\controllers\frontend';
            }
        }

        parent::init();
    }

}