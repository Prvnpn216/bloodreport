<?php

namespace app\modules\api\controllers;
use yii\data\Pagination;
use Yii;
use app\components\MubActiveController;
use app\models\AppUser;
use app\models\Post;

class PostController extends MubActiveController
{
    public $modelClass = 'app\models\Post';

    public function actionGetAllPosts(){
    $output["result"] = false;
    $postParams = Yii::$app->request->getBodyParams();
    if(isset($postParams['token'])){
      $user =  $this->authenticateUser($postParams['token']);
      if(!empty($user)){
        $output["result"] = true;
        $output["data"] = [];
        $posts = Post::find()->select(['id','post_title','image_url','notice','type','resource_id'])->where(['status' => 'Active','del_status' => '0'])->orderBy(['id' => SORT_DESC])->limit(10)->all();
        foreach ($posts as $postKey => $post){
          $comments = $post->latestComment;
          $post->image_url = $post->image_url;
          $output["data"][$postKey]['post'] = $post;
          if(!empty($comments))
          {
            $data = ['id' => $comments->id,'comment_text' => $comments->comment_text,'comment_count' => $comments->comments_count,'user_id'=> $comments->user_id, 'likes' => $comments->likes,'username' => AppUser::findOne($comments->user_id)->name,'user_image' => 'https://bootdey.com/img/Content/user_1.jpg'];
          }
          else
          {
            $data = new \stdClass();
          }
          $output["data"][$postKey]['comment'] = $data;
          $output["data"][$postKey]['comment'] = $data;
          $allUserLikes = Post::PostLikes($post->id);
          $likesCount = count($allUserLikes);
          $currentUserLike = in_array($user->id,$allUserLikes); 
          $output["data"][$postKey]['likes'] = ['count' => $likesCount,'user_like' => $currentUserLike];
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