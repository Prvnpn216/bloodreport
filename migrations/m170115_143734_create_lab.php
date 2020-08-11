<?php

namespace app\migrations;
use app\commands\Migration;
/**
 * Class m200808_104606_create_labs
 */
class m170115_143734_create_lab extends Migration
{
    public function getTableName()
    {
        return 'lab';
    }
    
    public function getKeyFields()
    {
        return [
            'id'  =>  'id',
            'name' => 'name'
        ];
    }

    public function getFields()
    {
        return [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'address' => "TEXT DEFAULT NULL",
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->dateTime(),
            'status' => "enum('Active','Inactive') NOT NULL DEFAULT 'Active'",
            'del_status' => "enum('0','1') NOT NULL COMMENT '0-Active,1-Deleted DEFAULT 0' DEFAULT '0'"
        ];
    }
    public function safeUp()
    {
        parent::safeUp();
        $sql = "INSERT INTO `lab` (`id`, `name`) VALUES(1, 'Quest'),(2, 'Lifeline'),(3, 'Sanjeevani'),(4, 'Maxx'),(5, 'Appolo'),(6, 'Breach Candy'),(7, 'Dr. Dang'),(8, 'Nueberg'),(9, 'SRL');";
        $this->execute($sql);    
    }
}
