<?php
use yii\helpers\Url;
?>
<?=Yii::$app->getFormatter()->asDatetime($model->created_at)?>
<a href="<?=Url::to(['default/view', 'alias'=>$model->alias])?>" class="list-group-item"><?=$model->name?></a>