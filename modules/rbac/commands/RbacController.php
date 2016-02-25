<?php

namespace modules\rbac\commands;

use modules\rbac\rules\AuthorRule;
use modules\rbac\rules\GroupRule;
use Yii;
use yii\console\Controller;

/**
 * RBAC console controller.
 */
class RbacController extends Controller
{
    /**
     * @inheritdoc
     */
    public $defaultAction = 'init';

    /**
     * Initial RBAC action.
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // Permissions
        $accessBackend = $auth->createPermission('accessBackend');
        $accessBackend->description = 'Can access backend';
        $auth->add($accessBackend);


        // Roles
        $guest = $auth->createRole('guest');
        $guest->description = 'User';
        $auth->add($guest);

        $admin = $auth->createRole('admin');
        $admin->description = 'Admin';
        $auth->add($admin);
        $auth->addChild($admin, $guest);
        $auth->addChild($admin, $accessBackend);

        $userGroupRule = new GroupRule();
        $auth->add($userGroupRule);
        $admin->ruleName  = $userGroupRule->name;

        $auth->assign($admin, 1);
    }
}
