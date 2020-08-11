<?php

namespace app\models;
use Yii;
use \app\components\Model;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;
use yii\helpers\Security;
use yii\db\ActiveRecord;

class User extends Model implements IdentityInterface
{
    public function rules()
    {
        return [
           [['first_name','last_name','username','password'], 'required'],
           [['created_at', 'updated_at','dob'], 'safe'],
           [['status', 'del_status','gender'], 'string'],
           [['first_name','last_name','username', 'password'], 'string', 'max' => 100],
           [['auth_key'], 'string', 'max' => 32],
           [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
           [['password_reset_token'], 'unique'],
       ];
    }

    public function attributeLabels()
    {
          return [
           'id' => Yii::t('app', 'ID'),
           'first_name' => Yii::t('app', 'first_name'),
           'last_name' => Yii::t('app', 'last_name'),
           'username' => Yii::t('app', 'Username'),
           'dob' => Yii::t('app','Date of Birth'),
           'auth_key' => Yii::t('app', 'Auth Key'),
           'gender' => Yii::t('app', 'Gender'),
           'password_hash' => Yii::t('app', 'Password Hash'),
           'password_reset_token' => Yii::t('app', 'Password Reset Token'),
           'password' => Yii::t('app', 'Password'),
           'created_at' => Yii::t('app', 'Created At'),
           'updated_at' => Yii::t('app', 'Updated At'),
           'status' => Yii::t('app', 'Status'),
           'del_status' => Yii::t('app', 'Del Status')
       ];
    }

    const STATUS_DELETED = 'Deactive';
    const STATUS_ACTIVE = 'Active';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function getMubUserId()
    {
        $userId = \Yii::$app->user->id;
        $mubUserModel = new \app\models\MubUser();
        $mubUserId = $mubUserModel::find()->where(['user_id' => $userId])->one();
        return $mubUserId->id;
    }
}
