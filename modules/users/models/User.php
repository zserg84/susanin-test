<?php

namespace modules\users\models;

use modules\users\Module as UserModule;;
use Yii;

/**
 * Class User
 * @package vova07\users\models
 * User model.
 *
 * @property integer $id ID
 * @property string $username Username
 * @property string $email E-mail
 * @property string $password_hash Password hash
 * @property string $auth_key Authentication key
 * @property string $role Role
 * @property integer $status_id Status
 * @property integer $created_at Created time
 * @property integer $updated_at Updated time
 *
 * @property Profile $profile Profile
 */
class User extends \common\models\User
{
}
