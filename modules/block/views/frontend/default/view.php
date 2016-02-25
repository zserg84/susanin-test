<?
use yii\widgets\ListView;
use yii\widgets\DetailView;

$this->title = 'Блок '. $model->name;
$category = $model->category;
$this->params['breadcrumbs'] = [];
if($parent = $category->parent){
    $this->params['breadcrumbs'][] = [
        'label' => 'Категория ' . $parent->name,
        'url' => ['category/view', 'id' => $parent->id]
    ];
}

$this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], [
    [
        'label' => 'Категория ' . $category->name,
        'url' => ['category/view', 'id' => $category->id]
    ],
    $this->title
]);

?>
<div class="row">
    <h1><?=$this->title?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'alias',
            'created_at' => [
                'attribute' => 'created_at',
                'format' => 'dateTime',
            ],
            'text' => [
                'attribute' => 'text',
                'value' => $model->getText(),
                'format' => 'ntext',
            ],
            'directory.name' => [
                'attribute' => 'directory.name',
                'value' => $model->directory,
            ],
            'image_id' => [
                'attribute' => 'image_id',
                'value'=>$model->image  ? $model->image->getSrc() : null,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ]
        ],
    ]) ?>
</div>
