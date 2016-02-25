<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 24.02.16
 * Time: 14:16
 */

namespace modules\block\controllers\backend;

use Imagine\Imagick\Imagine;
use modules\admin\components\Controller;
use modules\block\models\Block;
use modules\block\models\form\BlockForm;
use modules\block\models\search\BlockSearch;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

class DefaultController extends Controller
{

    public function actionIndex(){
        $model = new BlockSearch();
        $dataProvider = $model->search(\Yii::$app->getRequest()->get());

        return $this->render('index', [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate(){
        $model = new Block();
        $formModel = new BlockForm();

        if($formModel->load(\Yii::$app->getRequest()->post()) && $formModel->validate()){
            $model->setAttributes($formModel->attributes);
            if($model->save()){
                $this->afterEdit($model, $formModel);
                return $this->redirect(Url::to(['index']));
            }
        }

        return $this->render('create', [
            'model' => $model,
            'formModel' => $formModel,
        ]);
    }

    public function actionUpdate($id){
        $model = $this->findModel($id);
        $formModel = new BlockForm();
        $formModel->setAttributes($model->attributes);
        $formModel->image = $model->image;

        if($formModel->load(\Yii::$app->getRequest()->post()) && $formModel->validate()){
            $model->setAttributes($formModel->attributes);
            if($model->save()){
                $this->afterEdit($model, $formModel);
                return $this->redirect(Url::to(['index']));
            }
        }

        return $this->render('update', [
            'model' => $model,
            'formModel' => $formModel,
        ]);
    }

    public function afterEdit($model, $formModel)
    {
        $image = UploadedFile::getInstance($formModel, 'image');
        $formModel->image = $image;
        if ($image = $formModel->getImageModel('image')) {
            $model->image_id = $image->id;
            $model->save();
        }

        return $model;
    }

    public function actionDelete($id){
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect('index');
    }

    public function findModel($id){
        $model = Block::findOne($id);
        if(!$model)
            new Exception('Блок не найден');
        return $model;
    }
} 