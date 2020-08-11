<?php

namespace app\migrations;
use app\commands\Migration;

class m170115_143200_create_city extends Migration
{
    const TRANS_TYPE_FIELD = 1;
    const TRANS_TYPE_KEY = 2;
    const KEY_TYPE_INDEX = 1;
    const KEY_TYPE_FORIEGN = 2;

    public function getTableName()
    {
        return 'city';
    }

    public function getForeignKeyFields()
    {
        return [
            'state_id' => ['state', 'id'],
        ];
    }

    public function getKeyFields()
    {
        return [
            'city_name' => 'city_name',
            'state_id' => 'state_id',
            'order_by' => 'order_by'
        ];
    }

    public function getFields()
    {
        return ['id' => $this->primaryKey(),
        'city_name' => $this->string(100),
        'state_id' => $this->integer()->notNull(),
        'region_id' => $this->string(5),
        'order_by' => $this->integer()->notNull()->defaultValue(999),
        'pin_code' => $this->integer()
        ];
    }



    public function safeUp()
    {
        parent::safeUp();
        $file = __DIR__.'/../sql/city_list.sql';
        if(file_exists($file)){
          $sql = file_get_contents($file);
          $this->execute($sql);    
        }
        else
        {
            p($file);
        }
    }
    public function safeDown()
    {
        $this->dropKeys(self::KEY_TYPE_FORIEGN);
        $this->dropKeys(self::KEY_TYPE_INDEX);
        $this->dropTable($this->getTableName());
    }
}
