<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 08.06.15
 * Time: 12:44
 */

namespace modules\users\models\backend;

use modules\users\Module as UserModule;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

class User extends \modules\users\models\User
{

    public $permissions = [];

    /**
     * @var string|null Password
     */
    public $password;

    /**
     * @var string|null Repeat password
     */
    public $repassword;


    /**
     * @return array Role array.
     */
    public static function getRoleArray()
    {
        return ArrayHelper::map(\Yii::$app->authManager->getRoles(), 'name', 'description');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Required
            [['username'], 'required'],
            [['password', 'repassword'], 'required', 'on' => ['admin-create']],
            // Trim
            [['username', 'password', 'repassword'], 'trim'],
            // String
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 30],
            // Unique
            [['username'], 'unique'],
            // Username
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/'],
            ['username', 'string', 'min' => 3, 'max' => 30],
            // Repassword
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            // Status
            ['status', 'in', 'range' => array_keys(self::getStatusArray())],
            ['permissions', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'admin-create' => ['username', 'email', 'password', 'repassword', 'status'],
            'admin-update' => ['username', 'email', 'password', 'repassword', 'status']
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
                $this->generateToken();
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        call_user_func([
            get_parent_class(get_parent_class($this)), 'afterSave'
        ], $insert, $changedAttributes);

        if ($this->profile !== null) {
            $this->profile->save(false);
        }

        $auth = \Yii::$app->authManager;
        $modelPermissions = $this->permissions ? $this->permissions : [];

        if (!$insert) {
            $auth->revokeAll($this->id);
        }

        $roles = $auth->getRoles();
        $permissions = $auth->getPermissions();
        foreach($modelPermissions as $permission){
            $permissionValue = false;
            if(array_key_exists($permission, $permissions)){
                $permissionValue = $auth->getPermission($permission);
            }
            if(array_key_exists($permission, $roles)){
                $permissionValue = $auth->getRole($permission);
            }
            if($permissionValue)
                $auth->assign($permissionValue, $this->id);
        }
    }

    public static function defaultRolesPermissions(){
        return [
            'admin' => [
                'accessBackend',
            ],
            'guest' => [],
        ];
    }

    public static function getDefaultRolePermission($role){
        $permisssions = self::defaultRolesPermissions();
        return isset($permisssions[$role]) ? $permisssions[$role] : null;
    }
} 