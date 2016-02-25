<?php

namespace modules\users\models;

use modules\users\Module as UserModule;
use modules\users\Module;
use vova07\users\traits\ModuleTrait;
use Yii;
use yii\base\Model;

/**
 * Class LoginForm
 * @package vova07\users\models
 * LoginForm is the model behind the login form.
 *
 * @property string $username Username
 * @property string $password Password
 * @property boolean $rememberMe Remember me
 */
class LoginForm extends Model
{
    /**
     * @var string $username Username
     */
    public $username;

    /**
     * @var string $password Password
     */
    public $password;

    /**
     * @var boolean rememberMe Remember me
     */
    public $rememberMe = true;

    /**
     * @var User|boolean User instance
     */
    private $_user = false;

    public function rules()
    {
        return [
            // Required
            [['username', 'password'], 'required'],
            // Password
            ['password', 'validatePassword'],
            // Remember Me
            ['rememberMe', 'boolean']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->$attribute)) {
                $this->addError($attribute, 'Неверный логин или пароль');
            }
        }
    }

    /**
     * Finds user by username.
     *
     * @return User|boolean User instance
     */
    protected function getUser()
    {
        if ($this->_user === false) {
            $user = User::findByUsername($this->username, 'active');
            if ($user !== null) {
                $module = Module::getInstance();
                if ($module instanceof Module) {

                } else {
                    $module = Yii::$app->getModule('users');
                }

                if ($module->isBackend) {
                    if (Yii::$app->authManager->checkAccess($user->id, 'accessBackend')) {
                        $this->_user = $user;
                    }
                } else {
                    $this->_user = $user;
                }
            }
        }
        return $this->_user;
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
    }
}
