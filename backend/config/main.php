<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'Тестовое задание',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'defaultRoute' => '/block/category/index/',
    'modules' => [
        'admin' => [
            'class' => 'modules\admin\Module'
        ],
        'users' => [
            'controllerNamespace' => 'modules\users\controllers\backend',
            'isBackend' => true,
        ],
        'block' => [
            'controllerNamespace' => 'modules\block\controllers\backend',
            'isBackend' => true,
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/backend/users/guest/login',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'baseUrl' => '/backend'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => '/block/category/index/',
                '<_m>/<_c>/<_a>' => '<_m>/<_c>/<_a>',
            ]
        ],

        'view' => [
            'theme' => 'modules\themes\admin\Theme'
        ],
    ],
    'params' => $params,
];
