<?php

namespace modules\users;

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
    public $controllerNamespace = 'modules\users\controllers\frontend';

    public static $name = 'users';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->isBackend === true) {
            $this->setViewPath('@modules/users/views/backend');
        } else {
            $this->setViewPath('@modules/users/views/frontend');
        }
    }

    public static function getPermissionsTree($permissionName, $permissionsAccess){
        $permissionsArray = [];
        $permissions = array_keys(Yii::$app->authManager->getChildren($permissionName));

        $i = 0;
        foreach($permissions as $k=>$permission){
            $permissionObject = Yii::$app->authManager->getPermission($permission);
            if(!$permissionObject)
                continue;

            $access = $permissionsAccess;
            if($permissionsAccess !== true)
                $access = in_array($permission, $permissionsAccess) ? true : $permissionsAccess;
            $childrenPermissions = self::getPermissionsTree($permission, $access);
            
            if($childrenPermissions){
                $children = $childrenPermissions;
            }
            else
                $children = [];

            if($permissionsAccess === true)
                $selected = $permissionsAccess;
            else
                $selected = in_array($permission, $permissionsAccess);
            $permissionsArray[$i] = [
                'title' => $permissionObject->data ? $permissionObject->data : $permissionObject->name,
                'key' => $permission,
                'children' => $children,
                'selected' => $selected,
            ];
            $i++;
        }
        return $permissionsArray;
    }
}
