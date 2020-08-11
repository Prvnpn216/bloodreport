<?php

namespace app\migrations;

use app\commands\Migration;

class m170115_143100_create_state extends Migration
{
    const TRANS_TYPE_FIELD = 1;
    const TRANS_TYPE_KEY = 2;
    const KEY_TYPE_INDEX = 1;
    const KEY_TYPE_FORIEGN = 2;

    public function getTableName()
    {
        return 'state';
    }

    public function getKeyFields()
    {
        return [
            'state_name' => 'state_name',
        ];
    }
    
    public function safeUp()
    {
        parent::safeUp();
        $file = __DIR__.'/../sql/state_list.sql';
        if(file_exists($file)){
          $sql = file_get_contents($file);
          $this->execute($sql);    
        }
        else{
            p($file);
        }
    }

    public function getFields()
    {
        return [
            'id' => $this->primaryKey(),
            'state_name' => $this->string(),
            'created_at' => $this->dateTime()->notNull()->defaultValue('1970-01-01 12:00:00'),
            'updated_at' => $this->dateTime()->notNull()->defaultValue('1970-01-01 12:00:00'),
            'del_status' => "enum('0','1') NOT NULL COMMENT '0-Active,1-Deleted DEFAULT 0' DEFAULT '0'",
        ];
    }

    public function safeDown()
    {
        $this->dropKeys(self::KEY_TYPE_FORIEGN);
        $this->dropKeys(self::KEY_TYPE_INDEX);
        $this->dropTable($this->getTableName());
    }
}
