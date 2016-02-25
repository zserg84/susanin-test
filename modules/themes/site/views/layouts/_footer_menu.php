<?php

/**
 * Footer menu view.
 * @var \yii\web\View $this View
 */

use vova07\themes\site\widgets\Menu;
use modules\themes\Module;

echo Menu::widget(
    [
        'options' => [
            'class' => 'footer_menu navbar-right',
        ],
        'items' => [
            [
                'label'=>Module::t('themes-site', 'About'),
                'url' => '/page/about/',
            ],
            [
                'label' => Module::t('themes-site', 'For organizers'),
                'url' => '/page/for_organizers/',
            ],
            [
                'label' => Module::t('themes-site', 'Agreement'),
                'url' => '/page/agreement/',
            ],
            [
                'label' => Module::t('themes-site', 'FAQ'),
                'url' => ['/faq/default/index/']
            ],
            [
                'label' => Module::t('themes-site', 'Feedback'),
                'url' => ['/feedback/']
            ],
        ]
    ]
);