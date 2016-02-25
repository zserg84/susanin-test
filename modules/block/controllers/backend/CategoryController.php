<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 24.02.16
 * Time: 14:17
 */

namespace modules\block\controllers\backend;


use modules\admin\components\Controller;
use modules\block\models\Category;
use modules\block\models\form\CategoryForm;
use modules\block\models\search\CategorySearch;
use yii\base\Exception;
use yii\helpers\Url;

class CategoryController extends Controller
{
    public function actionIndex(){
        $model = new CategorySearch();
        $dataProvider = $model->search(\Yii::$app->getRequest()->get());

        return $this->render('index', [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate(){
        $model = new Category();
        $formModel = new CategoryForm();

        if($formModel->load(\Yii::$app->getRequest()->post()) && $formModel->validate()){
            $model->setAttributes($formModel->attributes);
            if($model->save()){
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
        $formModel = new CategoryForm();
        $formModel->setAttributes($model->attributes);

        if($formModel->load(\Yii::$app->getRequest()->post()) && $formModel->validate()){
            $model->setAttributes($formModel->attributes);
            if($model->save()){
                return $this->redirect(Url::to(['index']));
            }
        }

        return $this->render('update', [
            'model' => $model,
            'formModel' => $formModel,
        ]);
    }

    public function actionDelete($id){
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect('index');
    }

    public function findModel($id){
        $model = Category::findOne($id);
        if(!$model)
            new Exception('Категория не найдена');
        return $model;
    }
} 