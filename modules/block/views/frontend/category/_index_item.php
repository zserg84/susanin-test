<?php
    use yii\helpers\Url;
?>
<a href="<?=Url::to(['category/view', 'id'=>$model->id])?>" class="list-group-item"><?=$model->name?></a>