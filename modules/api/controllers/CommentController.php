<?php

namespace app\modules\api\controllers;
use yii\data\Pagination;
use Yii;
use app\helpers\HtmlHelper;
use app\components\MubActiveController;
use app\models\Post;
use app\models\Doubts;
use app\models\Comments;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use app\helpers\ImageUploader;

class CommentController extends MubActiveController
{
	public $modelClass = 'app\models\Comments';
    CONST POSTCOMMENT = 'post_comment';
    CONST POSTREPLY = 'post_reply';
    CONST DOUBTCOMMENT = 'doubt_comment';
    CONST DOUBTREPLY = 'doubt_reply';

    public function actionCreateComment()
    {
    $output["result"] = false;
    $postParams['Comments'] = Yii::$app->request->getBodyParams();
    if(isset($postParams['Comments']['token'])&&
       isset($postParams['Comments']['resource_id'])&&
       isset($postParams['Comments']['comment_type'])&&
       isset($postParams['Comments']['comment_text'])){
        //verify if the comment is type post_comment and post exists
        $user = $this->authenticateUser($postParams['Comments']['token']);
       	if(!empty($user)){
       		$postParams['Comments']['user_id'] = $user->id;
            if(($postParams['Comments']['comment_type'] === self::POSTCOMMENT)||($postParams['Comments']['comment_type'] === self::POSTREPLY) ||($postParams['Comments']['comment_type'] === self::DOUBTCOMMENT)||($postParams['Comments']['comment_type'] === self::DOUBTREPLY)){
              
              //Verify if the request is for post or doubt
              if(($postParams['Comments']['comment_type'] === self::DOUBTCOMMENT)||
                ($postParams['Comments']['comment_type'] === self::DOUBTREPLY)){
                $exists = Doubts::find()->where(['id' => $postParams['Comments']['resource_id'],'del_status' => '0', 'status' => 'Active'])->count();
              }elseif(($postParams['Comments']['comment_type'] === self::POSTCOMMENT) ||
                  ($postParams['Comments']['comment_type'] === self::POSTREPLY)){

                  $exists = Post::find()->where(['id' => $postParams['Comments']['resource_id'],'del_status' => '0', 'status' => 'Active'])->count();
                }
                if($exists){
                    $comments = new Comments();
                    //unset($postParams['Comments']['token']);
                    if($comments->load($postParams) && $comments->validate()){
                        //check if image was sent along with comments
                        $comments->image_url = UploadedFile::getInstanceByName('image_url');
                        if(!empty($comments->image_url))
                        {
                            $imageUploader = new ImageUploader();
                            $uploadedImage = $imageUploader->uploadImages($comments,'image_url');
                        }
                        if($comments->save()){
                            $output["result"] = true;
                            $output["data"] = $comments; 
                        }
                        else
                        {
                            $output["result"] = false;
                            $output["message"] = current(current($comments->getErrors()));
                        }
                    }
                    else
                    {
                        $output["result"] = false;
                        $output["message"] = current(current($comments->getErrors())); 
                    }
                }
                else
                {
                    $output["result"] = false;
                    $output["message"] = "The resource was either deleted or suspended";  
                }
            }
            else
            {
                $output["result"] = false;
                $output["message"] = "Comment was not Intended to be posted on a Post";  
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

  public function actionUpdateComment()
  {
  $output["result"] = false;
  $postParams['Comments'] = Yii::$app->request->getBodyParams();
  if(isset($postParams['Comments']['token'])&&
     isset($postParams['Comments']['id'])&&
     isset($postParams['Comments']['resource_id'])&&
     isset($postParams['Comments']['comment_type'])&&
     isset($postParams['Comments']['comment_text'])){
      //verify if the comment is type post_comment and post exists
      $user = $this->authenticateUser($postParams['Comments']['token']);
      if(!empty($user)){
        $postParams['Comments']['user_id'] = $user->id;
          if(($postParams['Comments']['comment_type'] === self::POSTCOMMENT)||
            ($postParams['Comments']['comment_type'] === self::POSTREPLY) ||
            ($postParams['Comments']['comment_type'] === self::DOUBTCOMMENT)||
            ($postParams['Comments']['comment_type'] === self::DOUBTREPLY))
          {
              $exists = Post::find()
              ->where(['id' => $postParams['Comments']['resource_id'],'del_status' => '0', 'status' => 'Active'])
              ->count();
              if($exists){
                  $comments = Comments::findOne($postParams['Comments']['id']); 
                  //unset($postParams['Comments']['token']);
                  if($comments->load($postParams) && $comments->validate()){
                      //check if image was sent along with comments
                      $comments->image_url = UploadedFile::getInstanceByName('image_url');
                      if(!empty($comments->image_url))
                      {
                          $imageUploader = new ImageUploader();
                          $uploadedImage = $imageUploader->uploadImages($comments,'image_url');
                      }
                      $comments->updated_at = date('Y-m-d H:i:s',time());
                      if($comments->save()){
                          $output["result"] = true;
                          $output["data"] = $comments; 
                      }
                      else
                      {
                          $output["result"] = false;
                          $output["message"] = current(current($comments->getErrors()));
                      }
                  }
                  else
                  {
                      $output["result"] = false;
                      $output["message"] = current(current($comments->getErrors())); 
                  }
              }
              else
              {
                  $output["result"] = false;
                  $output["message"] = "The post was either deleted or suspended";  
              }
          }
          else
          {
              $output["result"] = false;
              $output["message"] = "Comment was not Intended to be posted on a Post";  
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


  public function actionDeleteComment(){
    $output["result"] = false;
    $postParams['Comments'] = Yii::$app->request->getBodyParams();
    if(isset($postParams['Comments']['token'])&&
       isset($postParams['Comments']['id'])){
        //verify if the comment is type post_comment and post exists
        $user = $this->authenticateUser($postParams['Comments']['token']);
        if(!empty($user)){
          $comment = Comments::findOne($postParams['Comments']['id']);
          if(!empty($comment)){
            //Check if deleter is the owner of the comment
            if($comment->user_id == $user->id){
              $comment->del_status = '1';
              if($comment->save()){
                $output['result'] = true;
                $output['data'] = 'Commnet Deleted successfully';
              }
              else
              {
                $output['result'] = false;
                $output['data'] = current(current($comment->getErrors()));
              }
            }
            else
            {
              $output["result"] = false;
              $output["message"] = "You don't have permission to alter/delete this comment";
            }
          }
          else
          {
            $output["result"] = false;
            $output["message"] = "Wrong Request!! Please check your request";
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

    /*
    This function will return all comments/replies on a post or a doubt 
    @arguments comment_type , resource_id
	*/
    public function actionGetAllComments(){
    $output["result"] = false;
    $postParams['Comments'] = Yii::$app->request->getBodyParams();
    if(isset($postParams['Comments']['token'])&&
       isset($postParams['Comments']['resource_id'])&&
       isset($postParams['Comments']['comment_type'])){
    	$user = $this->authenticateUser($postParams['Comments']['token']);
       	if(!empty($user)){
          //only allow type for Postcomment and dout comments
       		if(($postParams['Comments']['comment_type'] === self::POSTCOMMENT)||($postParams['Comments']['comment_type'] === self::DOUBTCOMMENT)){
       			
            if($postParams['Comments']['comment_type'] === self::POSTCOMMENT){
              //getting all active comments of selected type with replies
              $comments = Comments::find()->select(['id','user_id','comment_id','resource_id','image_url','video_url','comment_text','comment_type','created_at','updated_at'])->where(['resource_id' => $postParams['Comments']['resource_id'],'comment_type' => $postParams['Comments']['comment_type'],'del_status' => '0','status' => 'Active'])->orderBy(['id'=>SORT_DESC])->all();
            }
            else
            {
             $comments = Comments::find()->select(['id','user_id','comment_id','selected_answer','colorCode','resource_id','image_url','video_url','comment_text','comment_type','created_at','updated_at'])->where(['resource_id' => $postParams['Comments']['resource_id'],'comment_type' => $postParams['Comments']['comment_type'],'del_status' => '0','status' => 'Active'])->orderBy(['selected_answer'=>SORT_DESC])->all(); 
            }
            
       			$allComments = [];

            //getting all comments info
       			foreach ($comments as $commentIndex => $comment) {
       				$allComments[$commentIndex]['comment'] = $comment;
              $allComments[$commentIndex]['user'] = $comment->user;
              $allComments[$commentIndex]['user']['image'] = 'https://bootdey.com/img/Content/user_1.jpg';

              if($postParams['Comments']['comment_type'] === self::POSTCOMMENT){
                //getting Ids of all users who have liked the comment
                $allUserLikes = Comments::PostCommentLikes($comment->id);
              }
              elseif($postParams['Comments']['comment_type'] === self::DOUBTCOMMENT)
              {
                $allUserLikes = Comments::DoubtCommentLikes($comment->id);
              }
              $likesCount = count($allUserLikes);
              // p($allUserLikes);
              $currentUserLike = in_array($user->id,$allUserLikes); 
              $allComments[$commentIndex]['likes'] = ['count' => $likesCount,'user_like' => $currentUserLike];
              $allComments[$commentIndex]['replies'] = [];

              //differentiate the model based on request
              if($postParams['Comments']['comment_type'] === self::POSTCOMMENT){
                $commentsData = $comment->postReplies;
              }
              elseif($postParams['Comments']['comment_type'] === self::DOUBTCOMMENT){
                $commentsData = $comment->doubtReplies;
              }
              foreach ($commentsData as $replyIndex => $reply) {
                  $allComments[$commentIndex]['replies'][$replyIndex]['reply'] = $reply;
                  $allComments[$commentIndex]['replies'][$replyIndex]['user'] = $reply->user;
                  $allComments[$commentIndex]['replies'][$replyIndex]['user']['image'] = 'https://bootdey.com/img/Content/user_1.jpg';
                  if($postParams['Comments']['comment_type'] === self::POSTCOMMENT){
                    $allUserLikes = Comments::PostReplyLikes($reply->id);
                  }
                  elseif($postParams['Comments']['comment_type'] === self::DOUBTCOMMENT)
                  {
                    $allUserLikes = Comments::DoubtReplyLikes($reply->id);
                  }
                  $likesCount = count($allUserLikes);
                  $currentUserLike = in_array($user->id,$allUserLikes); 
                  $allComments[$commentIndex]['replies'][$replyIndex]['likes'] = ['count' => $likesCount,'user_like' => $currentUserLike];
                }
       			}
       			$output['result'] = true;
       			$output['data'] = $allComments;
       		}
       		else
       		{
       			$output["result"] = false;
            	$output["message"] = "Not a valid request!!";
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