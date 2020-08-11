<?php

namespace app\modules\api\controllers;
use Yii;
use app\helpers\HtmlHelper;
use app\components\MubActiveController;
use app\models\MubCategory;

class CategoryController extends MubActiveController
{
	public $modelClass = 'app\models\MubCategory';

	public function actionGetAllCategories(){
	$output["result"] = false;
    $postParams = Yii::$app->request->getBodyParams();
    if(isset($postParams['token'])){
       $user =  $this->authenticateUser($postParams['token']);
       if(!empty($user)){
            $output["result"] = true;
            $output["data"] = MubCategory::find()->select(['id','category_name'])->where(['status' => 'Active','del_status' => '0'])->all();
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