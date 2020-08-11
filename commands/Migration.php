<?php

namespace app\commands;

use yii\db\Migration as BaseMigration;

date_default_timezone_set('Asia/Kolkata'); 
/**
 * Migration is base class for all child migrations.
 *
 * @author Praveen Kumar <praveen@makeubig.com>
 */
abstract class Migration extends BaseMigration
{

    const KEY_TYPE_INDEX = 1;
    const KEY_TYPE_FORIEGN = 2;

    /**
     * @uses Get all fields to be created
     * @return array
     */
    abstract public function getFields();

    /**
     * @uses Get the name of the table
     * @return string
     */
    abstract public function getTableName();

    /**
     * @uses Override this method in child class if foriegnkey needed
     * @return array
     */
    public function getForeignKeyFields()
    {
        return [];
    }

    /**
     * @uses Override this method in child class if indexkey needed
     * @return array
     */
    public function getKeyFields()
    {
        return [];
    }

    /**
     * @uses Override this method in child class if tranlation needed
     * @return array
     */
    public function getTranslations()
    {
        return [];
    }

    public function safeUp()
    {
        $this->createTable($this->getTableName(), $this->getFields());
        $this->addKeys(self::KEY_TYPE_INDEX);
        $this->addKeys(self::KEY_TYPE_FORIEGN);
    }

    public function safeDown()
    {
        $this->dropKeys(self::KEY_TYPE_FORIEGN);
        $this->dropKeys(self::KEY_TYPE_INDEX);
        $this->dropTable($this->getTableName());
    }

    /**
     * @uses To create index key and foreign key only if fields defined in child class
     * @param integer $type - To identify key type index or foreign
     */
    public function addKeys($type = self::KEY_TYPE_INDEX)
    {
        $getKeyFields = ($type == self::KEY_TYPE_INDEX) ? $this->getKeyFields(): $this->getForeignKeyFields();
        $tablename = $this->getTableName();
        foreach ($getKeyFields as $key => $values) {
            $columnname = $key;
            if ($type == self::KEY_TYPE_INDEX) {
                $keyname = $values;
                $this->createIndex($keyname, $tablename, $columnname);
            } elseif ($type == self::KEY_TYPE_FORIEGN) {
                $reftablename = $values[0];
                $refcolumnname = $values[1];
                $keyname = $tablename . '_' . $columnname;
                $this->addForeignKey($keyname, $tablename, $columnname, $reftablename, $refcolumnname);
            }
        }
    }

    /**
     * @uses To drop index key and foreign key only if fields defined in child class
     * @param integer $type - To identify key type index or foreign
     */
    public function dropKeys($type = SELF::KEY_TYPE_INDEX)
    {
        $getKeyFields = ($type == self::KEY_TYPE_INDEX) ? $this->getKeyFields() : $this->getForeignKeyFields();
        $tablename = $this->getTableName();
        foreach ($getKeyFields as $key => $values) {
            if ($type == self::KEY_TYPE_INDEX) {
                $keyname = $values;
                $this->dropIndex($keyname, $tablename);
            } elseif ($type == self::KEY_TYPE_FORIEGN) {
                $columnname = $key;
                $keyname = $tablename . '_' . $columnname;
                $this->dropForeignKey($keyname, $tablename);
            }
        }
    }
}
