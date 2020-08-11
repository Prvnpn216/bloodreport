<?php 

namespace app\modules\MubAdmin\modules\users\models;
use app\components\Model;
use app\helpers\HtmlHelper;
use app\models\User;
use app\models\MubUser;

class UserProcess extends Model
{
    public $models = [];
    public $deps = [];
    public $relatedModels = [];
    
    public function getModels()
    {
        $mubUser = new MubUser(); 
        $this->models = [
            'mubUser' => $mubUser
        ];
        return $this->models;
    }

    public function getFormData()
    {
        $state = new \app\models\State();
        $allStates = $state->getAllStates();
        return ['allStates' => $allStates];
    }

    public function getRelatedModels($model)
    {
        $mubUser = $model;
        $this->relatedModels = [
            'mubUser' => $mubUser
        ];
        return $this->relatedModels;
    }

    private function saveUserData($mubUser)
    {
        if($mubUser->id)
        {
            $userModel = new User();
            $user = $userModel::findOne($mubUser->user_id);
        }
        else
        {
            $user = new User();
        }
        $user->first_name = $mubUser->first_name;
        $user->last_name = $mubUser->last_name;
        $user->username = $mubUser->username;
        $user->password = $mubUser->password;
        $user->dob = $mubUser->dob;
        $user->gender = $mubUser->gender;
        $user->setPassword($mubUser->password);
        $user->generateAuthKey();
        $user->generatePasswordResetToken();
        if($user->save())
        {
            $mubUser->user_id = $user->id;
            if($mubUser->save())
            {
                return $mubUser->id;
            }
               throw new \yii\web\HttpException(500, 'User saved but not MubUser'); 
        }
        p($user->getErrors());
    }


    private function saveMubUserContact($mubUserContacts)
    {
        return ($mubUserContacts->save()) ? $mubUserContacts->id : p($mubUserContacts->getErrors());
    } 

    public function saveData($data = [])
    {
        if (isset($data['mubUser']))
            {
            try {
                $mubUserId = $this->saveUserData($data['mubUser']);
                if ($mubUserId)
                {
                    return $mubUserId;    
                } 
                else
                {
                    throw new \yii\web\HttpException(500, 'User data not saved');
                } 
                }
                catch (\Exception $e)
                {
                    throw $e;
                }
            } 
            else
            {
                throw new \yii\web\HttpException(500, 'Model Not Loaded properly');
            }
    }
}