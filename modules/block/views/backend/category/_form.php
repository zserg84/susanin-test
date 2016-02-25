<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use modules\block\models\Category;
?>
<?php $form = ActiveForm::begin(); ?>
<?php $box->beginBody(); ?>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($formModel, 'parent_id')->dropDownList(ArrayHelper::map(Category::find()->parent()->all(), 'id', 'name'), [
                'prompt' => 'Выберите роительскую категорию'
            ])?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($formModel, 'name')->textInput()?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($formModel, 'active')->widget(\kartik\switchinput\SwitchInput::className(), [

            ])?>
        </div>
    </div>

<?php $box->endBody(); ?>
<?php $box->beginFooter(); ?>
<?= Html::submitButton(
    $model->isNewRecord ? 'Создать' : 'Обновить',
    [
        'class' => $model->isNewRecord ? 'btn btn-primary btn-large' : 'btn btn-success btn-large'
    ]
) ?>
<?php $box->endFooter(); ?>
<?php ActiveForm::end(); ?>