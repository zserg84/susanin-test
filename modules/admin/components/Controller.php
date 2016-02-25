<?php

namespace modules\admin\components;

use yii\filters\AccessControl;

/**
 * Main backend controller.
 */
class Controller extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['accessBackend']
                    ]
                ]
            ]
        ];
    }

    public function beforeAction($action){
        if(!\Yii::$app->getUser()->can('accessBackend') && !\Yii::$app->getUser()->getIsGuest())
            return $this->redirect('/');
        return parent::beforeAction($action);
    }
}
