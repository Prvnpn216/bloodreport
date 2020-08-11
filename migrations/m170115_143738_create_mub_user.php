<?php

namespace app\migrations;
use app\commands\Migration;

class m170115_143738_create_mub_user extends Migration
{

    public function getTableName()
    {
        return 'mub_user';
    }
    public function getForeignKeyFields()
    {
        return [
            'user_id' => ['user', 'id'],
        ];
    }

    public function safeUp()
    {
        parent::safeUp();
        $authAssignment = new \app\models\AuthAssignment();
        $mubUser = new \app\models\MubUser();
        $allAdmins = $authAssignment::find()->where(['item_name' => 'admin'])->all();
        foreach ($allAdmins as $admin) {
            $userModel = new \app\models\User();
            $mubUser = new \app\models\MubUser();
            $user = $userModel::find()->where(['id' => $admin->user_id])->one();
            $mubUser->first_name = $user->first_name;
            $mubUser->last_name = $user->last_name;
            $mubUser->gender = 'Male';
            $mubUser->username = $user->username;
            $mubUser->user_id = $user->id;
            $mubUser->password = $user->password;
            if($mubUser->save())
            {
                echo 'created mubuser admin \n';
            }
            else
            {
                p($mubUser->getErrors());
            }
        }
    }

    public function getKeyFields()
    {
        return [
            'user_id'  =>  'user_id',
            'username' => 'username'
        ];
    }

    public function getFields()
    {
        return [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->defaultValue(NULL),
            'first_name' => $this->string(50)->notNull()->defaultValue('John'),
            'last_name' => $this->string(50)->notNull()->defaultValue('doe'),
            'role' => $this->string(50),
            'gender' => "enum('Male','Female','Other') NOT NULL DEFAULT 'Male'",
            'dob' => $this->dateTime()->notNull()->defaultValue('1970-01-01 12:00:00'),
            'username' => $this->string(100)->notNull(),
            'password' => $this->string(100)->notNull(),
            'email' => $this->string(),
            'mobile' => $this->string(20),
            'otp'      => $this->string(8),
            'verified' => $this->string(5),
            'access_token' => "text",
            'image_path' => $this->string(),
            'account_type' => $this->string(10), 
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->dateTime(),
            'status' => "enum('Active','Inactive') NOT NULL DEFAULT 'Active'",
            'del_status' => "enum('0','1') NOT NULL COMMENT '0-Active,1-Deleted DEFAULT 0' DEFAULT '0'",
        ];
    }
}
