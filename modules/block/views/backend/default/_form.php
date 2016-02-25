<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use modules\block\models\Category;
use common\models\Directory;
use kartik\switchinput\SwitchInput;
use yii\helpers\Url;
use dosamigos\fileinput\BootstrapFileInput;
?>
<?php $form = ActiveForm::begin([
    'options' => [
        'id' => 'block_form',
        'enctype' => 'multipart/form-data',
    ]
]); ?>
<?php $box->beginBody(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($formModel, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name'))?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($formModel, 'name')->textInput()?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($formModel, 'alias')->textInput()?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($formModel, 'active')->widget(SwitchInput::className(), [

            ])?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($formModel, 'text')->textarea()?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($formModel, 'text_active')->widget(SwitchInput::className())?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($formModel, 'directory_id')->dropDownList(ArrayHelper::map(Directory::find()->all(), 'id', 'name'))?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($formModel, 'directory_active')->widget(SwitchInput::className())?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?
            $initialPreview = [];
            $previewConfig = [];
            $image = $formModel->image;
            if($image){
                $initialPreview[] = '<img src="'.$image->getSrc().'" alt="" class="file-preview-image">';
                $previewConfig[] = [
//                    'url' => Url::toRoute(['image-delete']),
//                    'key' => $image->id,
                ];
            }
            ?>
            <?= $form->field($formModel, 'image')->widget(BootstrapFileInput::className(), [
                'options' => ['accept' => 'image/*'],
                'clientOptions' => [
                    'browseClass' => 'btn btn-success',
                    'uploadClass' => 'btn btn-info',
                    'removeClass' => 'btn btn-danger',
                    'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
                    'showUpload' => false,
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $previewConfig,
                    'showRemove' => false,
                ]
            ])->error(false)->label($formModel->getAttributeLabel('image'));?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($formModel, 'image_active')->widget(SwitchInput::className())?>
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