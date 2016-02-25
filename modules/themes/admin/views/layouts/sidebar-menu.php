<?php

/**
 * Sidebar menu layout.
 *
 * @var \yii\web\View $this View
 */

use modules\themes\admin\widgets\Menu;
use modules\themes\Module;

echo Menu::widget(
    [
        'options' => [
            'class' => 'sidebar-menu'
        ],
        'items' => [
            [
                'label' => 'Категории',
                'url' => ['/block/category/index'],
                'icon' => 'fa-group',
                'visible' => Yii::$app->user->can('accessBackend'),
            ],
            [
                'label' => 'Блоки',
                'url' => ['/block/default/index'],
                'icon' => 'fa-group',
                'visible' => Yii::$app->user->can('accessBackend'),
            ],
        ]
    ]
);