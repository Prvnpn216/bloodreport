<?php

namespace app\modules\api\controllers;
use Yii;
use app\helpers\HtmlHelper;
use app\components\MubActiveController;
use app\models\Resources;

class ResourcesController extends MubActiveController
{
	public $modelClass = 'app\models\Resources';

	public function actionGetAllResources(){
	$output["result"] = false;
    $postParams = Yii::$app->request->getBodyParams();
    if(isset($postParams['token']) && 
       isset($postParams['type'])){
       $user =  $this->authenticateUser($postParams['token']);
       if(!empty($user)){
            $output["result"] = true;
            $output["data"] = Resources::find()->select(['id','title','category_id','type','thumbnail','url','embed','duration','created_at','updated_at'])->where(['type' => $postParams['type'],'status' => 'Active','del_status' => '0'])->all();
       }
       else
       {
            $output["result"] = false;
            $output["message"] = "User Not found!! Please verify if token has expired";  
       }
    }
    else
    {
       $output["result"] = false;
       $output["message"] = "Mandatory params were not set";  
    }
    return $output;
    }

}