<?php

namespace app\migrations;
use app\commands\Migration;

class m170115_143730_create_user extends Migration
{

    public function getTableName()
    {
        return 'user';
    }
    
    public function getKeyFields()
    {
        return [
            'id'  =>  'id',
        ];
    }

    public function safeUp()
    {
        parent::safeUp();
        $mubAdmin = new \app\models\User();
        $admin = new \app\models\User();
        $mubAdmin->username = 'mubadmin';
        $password = 'mub1234admin';
        $mubAdmin->first_name = 'Praveen';
        $mubAdmin->last_name = 'Chaurasia';
        $mubAdmin->dob = '1990-08-26 2:00:00';
        $mubAdmin->password = $password;
        $mubAdmin->setPassword($password);
        $mubAdmin->generateAuthKey();
        $mubAdmin->generatePasswordResetToken();
        if($mubAdmin->save())
        {
            echo 'created user mubAdmin \n';
        }
        else
        {
            p($mubAdmin->getErrors());
        }

        $admin->username = 'admin';
        $password = '1234';
        $admin->first_name = 'MakeUBig';
        $admin->last_name = 'Admin';
        $admin->dob = '1990-08-26 2:00:00';
        $admin->password = $password;
        $admin->setPassword($password);
        $admin->generateAuthKey();
        $admin->generatePasswordResetToken();
        if($admin->save())
        {
            echo 'created user admin \n';
        }else
        {
            p($admin->getErrors());
        }
    }

    public function getFields()
    {
        return [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(50)->notNull(),
            'last_name' => $this->string(50)->notNull(),
            'dob' => $this->dateTime()->notNull()->defaultValue('1970-01-01 12:00:00'),
            'username' => $this->string(100)->notNull(),
            'gender' => "enum('Male','Female','Other') NOT NULL DEFAULT 'Male'",
            'auth_key' => $this->string(32)->defaultValue(NULL),
            'password_hash' => $this->string()->defaultValue(NULL),
            'password_reset_token' => $this->string()->unique(),
            'password' => $this->string(100)->notNull(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->dateTime(),
            'status' => "enum('Active','Inactive') NOT NULL DEFAULT 'Active'",
            'del_status' => "enum('0','1') NOT NULL COMMENT '0-Active,1-Deleted DEFAULT 0' DEFAULT '0'",
        ];
    }
}
