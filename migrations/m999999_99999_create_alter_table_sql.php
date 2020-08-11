<?php

namespace app\migrations;

use app\commands\Migration;

/**
 * Class m200707_192944_create_alter_table_sql
 */
class m999999_99999_create_alter_table_sql extends Migration
{
   
    public function safeUp()
    {
        $file = __DIR__.'/../sql/alterTable.sql';
        if(file_exists($file)){
          $sql = file_get_contents($file);
          $this->execute($sql);    
        }
        else
        {
            p($file);
        }
    }

    public function getTableName()
    {
        return '';
    }

    public function getKeyFields()
    {
        return [];
    }

    public function getFields()
    {
        return [];
    }
    

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200707_192944_create_alter_table_sql cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200707_192944_create_alter_table_sql cannot be reverted.\n";

        return false;
    }
    */
}
