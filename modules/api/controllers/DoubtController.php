<?php

namespace app\modules\api\controllers;
use Yii;
use app\helpers\HtmlHelper;
use app\components\MubActiveController;
use app\models\Post;
use app\models\Doubts;
use app\models\AppUser;
use app\models\MubCategory;
use app\models\Comments;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use app\helpers\ImageUploader;

class DoubtController extends MubActiveController
{
	public $modelClass = 'app\models\Doubts';

  public function actionCreateDoubt(){
    $output["result"] = false;
    $postParams['Doubts'] = Yii::$app->request->getBodyParams();
    if(isset($postParams['Doubts']['token'])&&
    	isset($postParams['Doubts']['category_id'])&&
    	isset($postParams['Doubts']['doubt_text'])){
       $user =  $this->authenticateUser($postParams['Doubts']['token']);
       if(!empty($user)){
       		$postParams['Doubts']['user_id'] = $user->id;
       		$doubt = new Doubts();

          //Validated the input of user 
       		if($doubt->load($postParams) && $doubt->validate()){
            $doubt->image_url = UploadedFile::getInstanceByName('image_url');
            if(!empty($doubt->image_url))
            {
              $imageUploader = new ImageUploader();
              $uploadedImage = $imageUploader->uploadImages($doubt,'image_url');
            }
            if($doubt->save()){
              $output["result"] = true;
              $output["data"] = $doubt; 
            }
            else
            {
              $output["result"] = false;
              $output["message"] = current(current($doubt->getErrors()));
            }
       		}
       		else
       		{
       			$output["result"] = false;
            $output["message"] = current(current($doubt->getErrors()));
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

  public function actionGetAllDoubts(){
    $output["result"] = false;
    $postParams['Doubts'] = Yii::$app->request->getBodyParams();
    if(isset($postParams['Doubts']['token'])){
      $user =  $this->authenticateUser($postParams['Doubts']['token']);
      if(!empty($user)){
        $doubt = new Doubts();
        if(isset($postParams['Doubts']['category_id'])){
          $allDoubts = $doubt->find()->select(['id','user_id','category_id','doubt_text','image_url','status','(select count(*) from likes where resource_id = doubts.id and type = "doubt") as likes','created_at','updated_at'])->where(['status' => 'Active','del_status' => '0','category_id' => $postParams['Doubts']['category_id']])->orderBy(['id' => SORT_DESC])->limit(10)->all();
        }
        else
        {
          $allDoubts = $doubt->popularDoubts();
        }
        $output["result"] = true;
        foreach ($allDoubts as $doubtKey => $doubt)
        {
          $comments = $doubt->latestComment;
          $doubt->image_url = $doubt->image_url;
          $doubt->username = AppUser::findOne($doubt->user_id)->name;
          $doubt->user_image = 'https://bootdey.com/img/Content/user_1.jpg';
          $output["data"][$doubtKey]['doubt'] = $doubt;
          if(!empty($comments))
          {
            $data = ['id' => $comments->id,'comment_text' => $comments->comment_text,'comment_count' => $comments->comments_count,'user_id'=> $comments->user_id, 'likes' => $comments->likes,'username' => AppUser::findOne($comments->user_id)->name,'user_image' => 'https://bootdey.com/img/Content/user_1.jpg'];
          }
          else
          {
            $data= new \stdClass();
          }
          $output["data"][$doubtKey]['comment'] = $data;
          $allUserLikes = Doubts::DoubtLikes($doubt->id);
          $likesCount = count($allUserLikes);
          $currentUserLike = in_array($user->id,$allUserLikes); 
          $output["data"][$doubtKey]['likes'] = ['count' => $likesCount,'user_like' => $currentUserLike];
        } 
        if(empty($allDoubts)){
          $output['data'] = new \stdClass();
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

  public function actionUpdateDoubt(){
    $output["result"] = false;
    $postParams['Doubts'] = Yii::$app->request->getBodyParams();
    if(isset($postParams['Doubts']['token'])&&
      isset($postParams['Doubts']['id'])&&
      isset($postParams['Doubts']['category_id'])&&
      isset($postParams['Doubts']['doubt_text'])){
       $user =  $this->authenticateUser($postParams['Doubts']['token']);
       if(!empty($user)){
          $postParams['Doubts']['user_id'] = $user->id;
          $doubt = Doubts::findOne($postParams['Doubts']['id']);

          //Validated the input of user 
          if($doubt->load($postParams) && $doubt->validate()){
            $doubt->image_url = UploadedFile::getInstanceByName('image_url');
            if(!empty($doubt->image_url))
            {
              $imageUploader = new ImageUploader();
              $uploadedImage = $imageUploader->uploadImages($doubt,'image_url');
            }
            if($doubt->save()){
              $output["result"] = true;
              $output["data"] = $doubt; 
            }
            else
            {
              $output["result"] = false;
              $output["message"] = current(current($doubt->getErrors()));
            }
          }
          else
          {
            $output["result"] = false;
            $output["message"] = current(current($doubt->getErrors()));
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