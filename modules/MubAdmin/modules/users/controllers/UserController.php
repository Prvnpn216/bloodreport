<?php

namespace app\modules\MubAdmin\modules\users\controllers;

use Yii;
use app\models\MubUser;
use app\models\AppUser;
use app\models\AppUserSearch;
use app\models\MubUserSearch;
use app\modules\MubAdmin\modules\users\models\UserProcess;
use app\models\City;
use app\components\MubController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class UserController extends MubController
{

	public function getProcessModel()
    {
        return new UserProcess();
    }

    public function getPrimaryModel()
    {
        return new MubUser();
    }

    public function getSearchModel()
    {
        return new MubUserSearch();
    }

    public function actionAppUser(){
        $primaryMode = new AppUser();
        $searchModel = new AppUserSearch();
        $queryParams = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($queryParams);
        return $this->render('app-user',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}