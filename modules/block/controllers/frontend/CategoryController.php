<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 25.02.16
 * Time: 13:50
 */

namespace modules\block\controllers\frontend;

use common\components\FrontendController;
use modules\block\models\Block;
use modules\block\models\Category;
use yii\base\Exception;
use yii\data\ActiveDataProvider;

class CategoryController extends FrontendController
{
    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find()->parent()->active()->orderBy('id'),
            'pagination' => false,
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id){
        $model = $this->findModel($id);
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find()->active()->andWhere([
                'parent_id' => $id
            ])->orderBy('id'),
            'pagination' => false,
        ]);

        $blockDataProvider = new ActiveDataProvider([
            'query' => Block::find()->active()->andWhere([
                'category_id' => $id
            ])->orderBy('id'),
            'pagination' => false,
        ]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'blockDataProvider' => $blockDataProvider,
        ]);
    }

    public function findModel($id){
        $model = Category::findOne($id);
        if(!$model)
            throw new Exception('Unknown model');
        return $model;
    }
} 