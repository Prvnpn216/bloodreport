<?php

namespace app\modules\MubAdmin\controllers;

use Yii;
use app\components\MubController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DashboardController extends MubController
{
	public function getProcessModel()
	{

	}

	public function getPrimaryModel()
	{

	}

	public function getDataProviders()
	{
		return [];
	}

	public function actionSetAttribute()
    {
        if (Yii::$app->request->isAjax) 
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $params = \Yii::$app->request->getBodyParams();
            $model = new $params['model']();
            $dataModel = $model::findOne($params['id']);
            if($params['model'] == '\\app\\models\\User')
            {
                $mubUser = MubUser::findOne($params['id']);
                $dataModel = $model::find()->where(['id' => $mubUser->user_id,'del_status' => '0'])->one();
            }
            $dataModel->{$params['attribute']} = $params['value'];
            $response['message'] = 'Data Updated successfully';
            if(!$dataModel->save(false))
            {
                $key = array_keys($dataModel->getErrors());
                $response['message'] = $dataModel->getErrors()[$key];
            }
            return $response;
        } 
        else 
        {
            return false;
        }

    }
}