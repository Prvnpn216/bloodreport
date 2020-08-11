<?php

namespace app\commands;

use yii\console\controllers\MigrateController;

/**
 * MigrationController is base class to handle migration commands.
 *
 * @author Praveen Kumar <praveen@makeubig.com>
 */
class MigrationController extends MigrateController
{
    // public $migrationNamespaces = ['app\migrations'];

    protected function getNewMigrations()
    {
        $tempPath   = 'app/migrations';
        $migrations = [];
        foreach (parent::getNewMigrations() as $mig)
        {
            $migrations[$mig] = 1;
        }
        $this->migrationPath = 'app/migrations';
        foreach (parent::getNewMigrations() as $mig)
        {
            $migrations[$mig] = 1;
        }

        $this->migrationPath = $tempPath;
        unset($tempPath);
        $migs = array_keys($migrations);
        sort($migs);
        return $migs;
    }

    protected function createMigration($class)
    {
        $this->migrationPath = 'app/migrations';
        $file = $this->migrationPath . DIRECTORY_SEPARATOR . $class . '.php';
        if (!file_exists($file))
        {
            $basePath = 'app/migrations';
            $file     = $basePath . DIRECTORY_SEPARATOR . $class . '.php';
        }
        $class = str_replace('/', '\\', str_replace($class . '.php', '', $file)) . $class;
        return new  $class(['db' => $this->db]);
    }
}
