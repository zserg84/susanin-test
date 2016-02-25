<?
use yii\widgets\ListView;

$this->title = 'Категория '.$model->name;
$this->params['breadcrumbs'] = [
    [
        'label' => 'Категории',
        'url' => ['index'],
    ]
];
if($parent = $model->parent){
    $this->params['breadcrumbs'][] = [
        'label' => 'Категория '.$parent->name,
        'url' => ['category/view', 'id' => $parent->id]
    ];
}
$this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], [
    $this->title
]);

?>
<div class="row">
    <h1><?=$this->title?></h1>
</div>
<?if($dataProvider->totalCount):?>
<div class="row">
    <h3>Подкатегории</h3>
    <div class="col-xs-12">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_index_item',['model' => $model]);
            },
            'options' => [
                'tag' => 'div',
                'class' => 'list-group',
            ],
            'itemOptions' => [
                'class' => 'list-group-item'
            ],
            'summary' => false,
        ]); ?>
    </div>
</div>
<?endif?>
<?if($blockDataProvider->totalCount):?>
<div class="row">
    <h3>Блоки</h3>
    <div class="col-xs-12">
        <?= ListView::widget([
            'dataProvider' => $blockDataProvider,
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_block_item',['model' => $model]);
            },
            'options' => [
                'tag' => 'div',
                'class' => 'list-group',
            ],
            'itemOptions' => [
                'class' => 'list-group-item'
            ],
            'summary' => false,
        ]); ?>
    </div>
</div>
<?endif?>