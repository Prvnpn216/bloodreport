<?php

namespace app\migrations;
use app\commands\Migration;

class m170115_143733_create_patient extends Migration
{
    public function getTableName()
    {
        return 'patient';
    }
    public function getKeyFields()
    {
        return [
            'id'  =>  'id',
            'mobile' => 'mobile'
        ];
    }
    public function getFields()
    {
        return [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'email' => $this->string()->defaultValue(NULL),
            'mobile' => $this->string(20)->notNull(),
            'address' => "TEXT DEFAULT NULL",
            'clinic_name' => $this->string()->defaultValue(NULL),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->dateTime(),
            'status' => "enum('Active','Inactive') NOT NULL DEFAULT 'Active'",
            'del_status' => "enum('0','1') NOT NULL COMMENT '0-Active,1-Deleted DEFAULT 0' DEFAULT '0'"
        ];
    }
}
