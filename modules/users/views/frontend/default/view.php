<?php
/**
 * Страница одного пользователя.
 * @var yii\base\View $this
 */

use yii\helpers\Html;

$this->title = $model['username'];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo Html::encode($this->title); ?></h1>