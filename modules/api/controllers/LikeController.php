<?php

namespace app\modules\api\controllers;
use Yii;
use app\helpers\HtmlHelper;
use app\components\MubActiveController;
use app\models\Likes;

class LikeController extends MubActiveController
{
	public $modelClass = 'app\models\Likes';

	public function actionToggle(){
	$output["result"] = false;
    $postParams['Likes'] = Yii::$app->request->getBodyParams();
    if(isset($postParams['Likes']['token'])&&
      isset($postParams['Likes']['type'])&&
      isset($postParams['Likes']['resource_id'])){
       $user =  $this->authenticateUser($postParams['Likes']['token']);
       if(!empty($user))
       {
          $postParams['Likes']['user_id'] = $user->id;
          $liked = Likes::find()->where(['user_id' => $user->id,'type' => $postParams['Likes']['type'],'resource_id' => $postParams['Likes']['resource_id']])->one();
          if(!empty($liked)){
            if($liked->delete())
            {
              $output["result"] = true;
              $output["message"] = 'Un-Liked';
            }
            else
            {
              $output["result"] = false;
              $output["message"] = current(current($liked->getErrors()));
            }
          }
          else
          {
            $like = new Likes();
            if($like->load($postParams) && $like->save())
            {
              $output["result"] = true;
              $output["message"] = 'Liked';
            }
            else
            {
              $output["result"] = false;
              $output["message"] = current(current($like->getErrors()));
            }
          }
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