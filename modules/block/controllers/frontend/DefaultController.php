<?php
/**
 * Created by PhpStorm.
 * User: sz
 * Date: 25.02.16
 * Time: 14:23
 */

namespace modules\block\controllers\frontend;


use common\components\FrontendController;
use modules\block\models\frontend\Block;
use yii\base\Exception;
use yii\helpers\VarDumper;

class DefaultController extends FrontendController
{

    public function actionView($alias){
        $model = Block::find()->active()->getByAlias($alias)->one();
        if(!$model)
            throw new Exception('Block was not found');
        return $this->render('view', [
            'model' => $model
        ]);
    }
} 