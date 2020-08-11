<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mub_user".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $role
 * @property string $gender
 * @property string $dob
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $mobile
 * @property string $otp
 * @property string $verified
 * @property string $access_token
 * @property string $image_path
 * @property string $account_type
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 * @property string $del_status
 *
 * @property Comments[] $comments
 * @property User $user
 * @property Post[] $posts
 * @property QuestionOptions[] $questionOptions
 * @property Quiz[] $quizzes
 * @property QuizQuestion[] $quizQuestions
 */
class MubUser extends \app\components\Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mub_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['username', 'password'], 'required'],
            [['gender', 'access_token', 'status', 'del_status'], 'string'],
            [['dob', 'created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name', 'role'], 'string', 'max' => 50],
            [['username', 'password'], 'string', 'max' => 100],
            [['email', 'image_path'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 20],
            [['otp'], 'string', 'max' => 8],
            [['verified'], 'string', 'max' => 5],
            [['account_type'], 'string', 'max' => 10],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'role' => 'Role',
            'gender' => 'Gender',
            'dob' => 'Dob',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'otp' => 'Otp',
            'verified' => 'Verified',
            'access_token' => 'Access Token',
            'image_path' => 'Image Path',
            'account_type' => 'Account Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'del_status' => 'Del Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['mub_user_id' => 'id'])->where(['del_status' => '0']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->where(['del_status' => '0']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['mub_user_id' => 'id'])->where(['del_status' => '0']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionOptions()
    {
        return $this->hasMany(QuestionOptions::className(), ['mub_user_id' => 'id'])->where(['del_status' => '0']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizzes()
    {
        return $this->hasMany(Quiz::className(), ['mub_user_id' => 'id'])->where(['del_status' => '0']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizQuestions()
    {
        return $this->hasMany(QuizQuestion::className(), ['mub_user_id' => 'id'])->where(['del_status' => '0']);
    }

}
