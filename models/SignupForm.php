<?php
namespace app\models;

use app\components\Model;

class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $gender;
    public $dob;
    public $email;
    public $password_confirm;
    public $mobile;
    public $address;
    public $domain;
    public $organization;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','first_name','last_name'], 'trim'],
            [['first_name','last_name','email','password'], 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['email','email'],
            ['password_confirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"],
            [['username','first_name','last_name','address','organization'], 'string', 'min' => 2, 'max' => 255],
            ['mobile','number'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = ($this->username) ? $this->username : $this->email;
        $user->password = $this->password;
        $user->dob = ($this->dob) ? $this->dob : '1970-01-01 12:00:00';
        $user->gender = ($this->gender) ? $this->gender : 'Male';
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generatePasswordResetToken();
        if($user->save())
        {
            $auth = \Yii::$app->authManager;
            $subadmin = $auth->createRole('subadmin');
            $auth->assign($subadmin, $user->id);
            $mubUser = new \app\models\MubUser();
            $mubUserContact = new \app\models\MubUserContact();
            $mubUser->user_id = $user->id;
            $mubUser->first_name = $this->first_name;
            $mubUser->last_name = $this->last_name;
            $mubUser->username = ($this->username) ? $this->username : $this->email;
            $mubUser->password = $this->password;
            $mubUser->gender = ($this->gender) ? $this->gender : 'Male';
            $mubUser->dob = ($this->dob) ? $this->dob : '1970-01-01 12:00:00';
            $mubUser->domain = ($this->domain) ? $this->domain : 'www.yourwebsite.com';
            $mubUser->organization = ($this->organization) ? $this->organization : 'Your Company';
            $mubUser->status = 'Inactive';
            if($mubUser->save(false))
            {
                $mubUserContact->mub_user_id = $mubUser->id;
                $mubUserContact->city = '125';
                $mubUserContact->pin_code = '1100089';
                $mubUserContact->landline = '023456789';
                $mubUserContact->email = ($this->email) ? $this->email: 'email@company.com';
                $mubUserContact->mobile = ($this->mobile) ? $this->mobile : '0987654321';
                $mubUserContact->address = ($this->address) ? $this->address : 'Your complete address'; 
                if($mubUserContact->save(false))
                {
                    $transaction->commit();
                    return $user;
                }
                else
                {
                    $errors = implode(',', $mubUserContact->getErrors());
                throw new yii\web\ForbiddenHttpException('User Not Created Because : '. $errors);
                }    
            }
            else
            {
                $errors = implode(',', $mubUser->getErrors());
                throw new yii\web\ForbiddenHttpException('User Not Created Because : '. $errors);
            }
        }
        $errors = implode(',', $user->getErrors());
        throw new yii\web\ForbiddenHttpException('User Not Created Because : '. $errors);
        }
        catch (\Exception $e) {
                    $transaction->rollBack();
                    p($e);
                }
          return null;
    }
}
