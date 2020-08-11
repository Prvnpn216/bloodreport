<?php
namespace app\components;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

date_default_timezone_set('Asia/Kolkata'); 

abstract class MubController extends \yii\web\Controller
{
    public $layout = "@app/views/layouts/admin";

    /**
     * Get object of a model that is master to another models
     * @return mixed
     */
    abstract public function getPrimaryModel();

    /**
     * Get object of a model that holds all the models in multi model controllers
     * @return mixed
     */
    abstract public function getProcessModel();

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'index', 'create', 'update', 'view', 'delete', 'resetpassword','upload'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'forgotpassword'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $controller = Yii::$app->controller->id;
                            $action = Yii::$app->controller->action->id;
                            $route = "$controller/$action";
                            if(\Yii::$app->user->can($route) || \Yii::$app->user->can($controller))
                            {
                                return true;
                            }
                        }
                    ],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }

    /**
     * Lists all Demo models.
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index', $this->getDataProviders());
    }
    /* 
        This is the function that has to be overriden in child controller if the provider for any controller is
        to be changed
    */
    protected function getDataProviders()
    {
        $searchModel = $this->getSearchModel();
        $queryParams = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($queryParams);
        return [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ];
    }

    public function getUserRole()
    {
        $userId = \Yii::$app->user->id;
        $role = \Yii::$app->authManager->getRolesByUser($userId);
        $roles = array_keys($role);
        return $roles[0];
    }

    //}

    /**
     * Displays a single Demo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $storage = $this->getProcessModel();
        $relatedModels = $storage->getRelatedModels($model);
        return $this->render('view', $relatedModels);
    }

    /**
     * Creates a new UsedCar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() { 
        $storage = $this->getProcessModel();
        $deps = $storage->getFormData();
        $models = $storage->getModels();
        if (Yii::$app->request->post()) {
            foreach ($models as $key => $model) {
                try {
                    $model->load(Yii::$app->request->post());
                } catch (\Exception $e) {
                    Yii::$app->getSession()->setFlash('error', $model->getErrors());
                    break;
                }
            }
        
            if (Model::validateMultiple($models)) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                        $id = $storage->saveData($models);
                        $transaction->commit();
                        $class = new \ReflectionClass(get_called_class());
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                }
                return $this->redirect(['view', 'id' => $id]);
            }
            else
            {
                foreach ($models as $key => $model) {
                    if(!empty($model->getErrors())){
                        p($model->getErrors());
                    }
                }
            }
        }
        return $this->render('create', array_merge($models, $deps));
    }

    /**
     * Updates an existing Demo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model_main = $this->findModel($id);
        $storage = $this->getProcessModel();
        $relatedModels = $storage->getRelatedModels($model_main);
        $deps = $storage->getFormData();
        $additionalParams = $this->getAdditionalParams($model_main);
        if (Yii::$app->request->post()) {

            foreach ($relatedModels as $key => $model) {
                try {
                    $model->load(Yii::$app->request->post());
                } catch (\Exception $e) {
                    Yii::$app->getSession()->setFlash('error', $model->getErrors());
                    break;
                }
            }
            if (Model::validateMultiple($relatedModels)) {
                $id = $storage->saveData($relatedModels);
                $class = new \ReflectionClass(get_called_class());
                return $this->redirect(['view', 'id' => $id]);
            }
        }
        return $this->render('update', array_merge($relatedModels, $deps, $additionalParams));
    }

    public function getAdditionalParams()
    {
        return [];
    }

    /**
     * Deletes an existing Demo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @auther Praveen Kumar <praveen@makeubig.com>
     */
    public function actionDelete($id) {
        $model_main = $this->findModel($id);
        $storage = $this->getProcessModel();
        $relatedModels = $storage->getRelatedModels($model_main);
        foreach ($relatedModels as $key => $model) {
            $model->del_status = '1';
            $model->save(false);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Demo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Demo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $del_status = '0') {
        $class = get_class($this->getPrimaryModel());
        if (($model = $class::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // show listing of dealer and inventory according to their roles and permission 

    public function getDataByRole() {
        $mubUserId = \app\models\User::getMubUserId();
        $user_id = Yii::$app->user->id;
        $queryParams = Yii::$app->request->getQueryParams();
        $searchModel = $this->getSearchModel();
        $searchClassName = \yii\helpers\StringHelper::basename(get_class($searchModel));
        if ($searchClassName != 'PostSearch') {
            if (getAuthRole() == 'admin') {
                $getParent = (new \yii\db\Query())->select(['id'])->from('mub_user')
                        ->where([ 'admin_id' => Yii::$app->user->id])
                        ->orFilterWhere(['id' => $dealerId])
                        ->all();
                $parentIdArray = array();
                foreach ($getParent as $val) {
                    foreach ($val as $value) {
                        $parentIdArray[] = $value;
                    }
                }
                $queryParams[$searchClassName]["dealer_id"] = $parentIdArray;
            } else if (getAuthRole() != 'superadmin') {
                $queryParams[$searchClassName]["dealer_id"] = $dealerId;
            }
        } else {
            if (getAuthRole() == 'admin') {
                $queryParams[$searchClassName]["admin_id"] = $user_id;
            } else if (getAuthRole() != 'superadmin') {
                $queryParams[$searchClassName]['user_id'] = $user_id;
            }
        }
        return $queryParams;
    }
}