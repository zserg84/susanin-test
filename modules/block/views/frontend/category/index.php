<?
use yii\widgets\ListView;

$this->title = 'Категории';
$this->params['breadcrumbs'] = [
    $this->title
];

?>
<h1><?=$this->title?></h1>
<div class="row">
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