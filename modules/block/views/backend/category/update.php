<?php

use modules\themes\admin\widgets\Box;
use modules\event\Module as EventModule;
use modules\event\widgets\EventCategoryLangWidget;

$this->title = 'Категории';
$this->params['subtitle'] = 'Редактирование';
$this->params['breadcrumbs'] = [
    [
        'label' => $this->title,
        'url' => ['index'],
    ],
    $this->params['subtitle']
];
$boxButtons = ['{cancel}'];

$boxButtons[] = '{delete}';
$boxButtons = !empty($boxButtons) ? implode(' ', $boxButtons) : null; ?>
<div class="row">
    <div class="col-sm-12">
        <?php $box = Box::begin(
            [
                'title' => $this->params['subtitle'],
                'renderBody' => false,
                'options' => [
                    'class' => 'box-success'
                ],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => $boxButtons
            ]
        );
        echo $this->render(
            '_form',
            [
                'model' => $model,
                'box' => $box,
                'formModel' => $formModel,
            ]
        );
        Box::end(); ?>
    </div>
</div>