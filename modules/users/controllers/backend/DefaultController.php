<?php

namespace modules\users\controllers\backend;

use modules\admin\components\Controller;
use modules\users\models\backend\User;
use modules\users\models\backend\UserSearch;
use modules\users\models\Profile;
use modules\users\Module as UserModule;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Default backend controller.
 */
class DefaultController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            /*'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => $this->module->avatarsTempPath
            ]*/
        ];
    }

    /**
     * Users list page.
     */
    function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Create user page.
     */
    public function actionCreate()
    {
        $user = new User(['scenario' => 'admin-create']);
        $profile = new Profile();
        $statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            if ($user->validate() && $profile->validate()) {
                $user->populateRelation('profile', $profile);
                if ($user->save(false)) {
                    return $this->redirect(['update', 'id' => $user->id]);
                } else {
                    Yii::$app->session->setFlash('danger', UserModule::t('users', 'BACKEND_FLASH_FAIL_ADMIN_CREATE'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return array_merge(ActiveForm::validate($user), ActiveForm::validate($profile));
            }
        }

        return $this->render('create', [
                'user' => $user,
                'profile' => $profile,
                'roleArray' => $roleArray,
                'statusArray' => $statusArray
            ]);
    }

    /**
     * Update user page.
     *
     * @param integer $id User ID
     *
     * @return mixed View
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $user->setScenario('admin-update');
        $profile = $user->profile;
        $statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            if ($user->validate() && $profile->validate()) {
                $user->populateRelation('profile', $profile);

                $user->permissions = Yii::$app->getRequest()->post('permissions');

                if (!$user->save(false)) {
                    Yii::$app->session->setFlash('danger', UserModule::t('users', 'BACKEND_FLASH_FAIL_ADMIN_CREATE'));
                }
                return $this->refresh();
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return array_merge(ActiveForm::validate($user), ActiveForm::validate($profile));
            }
        }

        return $this->render('update', [
                'user' => $user,
                'profile' => $profile,
                'roleArray' => $roleArray,
                'statusArray' => $statusArray
            ]);
    }

    /**
     * Delete user page.
     *
     * @param integer $id User ID
     *
     * @return mixed View
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Delete multiple users page.
     */
    public function actionBatchDelete()
    {
        if (($ids = Yii::$app->request->post('ids')) !== null) {
            $models = $this->findModel($ids);
            foreach ($models as $model) {
                $model->delete();
            }
            return $this->redirect(['index']);
        } else {
            throw new HttpException(400);
        }
    }

    public function actionGetPermissionsByRole($role){
        $permissionsAccess = User::getDefaultRolePermission($role);
        return $this->renderAjax('_permission_list', [
            'permissionsAccess' => $permissionsAccess,
        ]);
    }

    /**
     * Find model by ID
     *
     * @param integer|array $id User ID
     *
     * @return \vova07\users\models\backend\User User
     * @throws HttpException 404 error if user was not found
     */
    protected function findModel($id)
    {
        if (is_array($id)) {
            /** @var User $user */
            $model = User::findIdentities($id);
        } else {
            /** @var User $user */
            $model = User::findIdentity($id);
        }
        if ($model !== null) {
            return $model;
        } else {
            throw new HttpException(404);
        }
    }
}
