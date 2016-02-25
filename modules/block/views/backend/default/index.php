<?php

use yii\grid\CheckboxColumn;
use yii\jui\DatePicker;
use yii\grid\ActionColumn;
use modules\themes\admin\widgets\Box;
use yii\grid\GridView;
use \yii\helpers\Html;
use modules\themes\Module as ThemeModule;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use modules\block\models\Category;

$this->title = 'Блоки';
$this->params['subtitle'] = 'Список';
$this->params['breadcrumbs'] = [
    $this->title
];

$gridId = 'category-grid';

$gridConfig = [
    'id' => $gridId,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,

    'columns' => [
        [
            'class' => CheckboxColumn::classname()
        ],
        'id', 'name', 'alias',
        [
            'attribute' => 'categoryName',
            'format' => 'html',
            'filter' => Html::activeDropDownList($searchModel, 'categoryName',
                ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                ['class'=>'form-control','prompt' => 'Выберите категорию']
            ),
        ],
        [
            'attribute' => 'active',
            'format' => 'html',
            'filter' => Html::activeDropDownList($searchModel, 'active',
                ['Нет', 'Да'],
                ['class'=>'form-control','prompt' => 'Активный/не активный']
            ),
            'value' => function($data){
                return Yii::$app->getFormatter()->asBoolean($data->active);
            }
        ],
    ]
];

$boxButtons = $actions = [];

$boxButtons[] = '{create}';

$actions[] = '{update}';

$gridButtons = [];
$actions[] = '{delete}';
$gridButtons['delete'] = function ($url, $model) {
    return \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id],
        [
            'class' => 'grid-action',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
                'pjax' => '0',
            ],
        ]);
};

$gridConfig['columns'][] = [
    'class' => ActionColumn::className(),
    'template' => implode(' ', $actions),
    'buttons'=>$gridButtons,
];
$boxButtons = !empty($boxButtons) ? implode(' ', $boxButtons) : null; ?>

<div class="row">
    <div class="col-xs-12">
        <?php Box::begin(
            [
                'title' => $this->params['subtitle'],
                'bodyOptions' => [
                    'class' => 'table-responsive'
                ],
                'buttonsTemplate' => $boxButtons,
                'grid' => $gridId
            ]
        ); ?>
        <?= GridView::widget($gridConfig); ?>
        <?php Box::end(); ?>
    </div>
</div>