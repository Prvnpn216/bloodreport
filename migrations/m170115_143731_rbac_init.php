<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\migrations;

Use Yii;

use \yii\base\InvalidConfigException;
use \yii\rbac\DbManager;

/**
 * Initializes RBAC tables
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @since 2.0
 */
class m170115_143731_rbac_init extends \yii\db\Migration
{
    /**
     * @throws yii\base\InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }
        return $authManager;
    }

    /**
     * @return bool
     */
    protected function isMSSQL()
    {
        return $this->db->driverName === 'mssql' || $this->db->driverName === 'sqlsrv' || $this->db->driverName === 'dblib';
    }

    /**
     * @inheritdoc
     */
    public function up()
    {
        $authManager = $this->getAuthManager();
        $this->db = $authManager->db;

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($authManager->ruleTable, [
            'name' => $this->string(64)->notNull(),
            'data' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY (name)',
        ], $tableOptions);

        $this->createTable($authManager->itemTable, [
            'name' => $this->string(64)->notNull(),
            'type' => $this->integer()->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY (name)',
            'FOREIGN KEY (rule_name) REFERENCES ' . $authManager->ruleTable . ' (name)'.
                ($this->isMSSQL() ? '' : ' ON DELETE SET NULL ON UPDATE CASCADE'),
        ], $tableOptions);
        $this->createIndex('idx-auth_item-type', $authManager->itemTable, 'type');

        $this->createTable($authManager->itemChildTable, [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY (parent, child)',
            'FOREIGN KEY (parent) REFERENCES ' . $authManager->itemTable . ' (name)'.
                ($this->isMSSQL() ? '' : ' ON DELETE CASCADE ON UPDATE CASCADE'),
            'FOREIGN KEY (child) REFERENCES ' . $authManager->itemTable . ' (name)'.
                ($this->isMSSQL() ? '' : ' ON DELETE CASCADE ON UPDATE CASCADE'),
        ], $tableOptions);

        $this->createTable($authManager->assignmentTable, [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->string(64)->notNull(),
            'created_at' => $this->integer(),
            'PRIMARY KEY (item_name, user_id)',
            'FOREIGN KEY (item_name) REFERENCES ' . $authManager->itemTable . ' (name) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        $this->createPermission();
        $this->createRole();
        $this->assignRole();
        $this->createDashboardRule();
        
        if($this->isMsSQL()) {
            $this->execute("CREATE TRIGGER dbo.trigger_auth_item_child
            ON dbo.{$authManager->itemTable}
            INSTEAD OF DELETE, UPDATE
            AS
            DECLARE @old_name VARCHAR (64) = (SELECT name FROM deleted)
            DECLARE @new_name VARCHAR (64) = (SELECT name FROM inserted)
            BEGIN
            IF COLUMNS_UPDATED() > 0
                BEGIN
                    IF @old_name <> @new_name
                    BEGIN
                        ALTER TABLE auth_item_child NOCHECK CONSTRAINT FK__auth_item__child;
                        UPDATE auth_item_child SET child = @new_name WHERE child = @old_name;
                    END
                UPDATE auth_item
                SET name = (SELECT name FROM inserted),
                type = (SELECT type FROM inserted),
                description = (SELECT description FROM inserted),
                rule_name = (SELECT rule_name FROM inserted),
                data = (SELECT data FROM inserted),
                created_at = (SELECT created_at FROM inserted),
                updated_at = (SELECT updated_at FROM inserted)
                WHERE name IN (SELECT name FROM deleted)
                IF @old_name <> @new_name
                    BEGIN
                        ALTER TABLE auth_item_child CHECK CONSTRAINT FK__auth_item__child;
                    END
                END
                ELSE
                    BEGIN
                        DELETE FROM dbo.{$authManager->itemChildTable} WHERE parent IN (SELECT name FROM deleted) OR child IN (SELECT name FROM deleted);
                        DELETE FROM dbo.{$authManager->itemTable} WHERE name IN (SELECT name FROM deleted);
                    END
            END;");
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $authManager = $this->getAuthManager();
        $this->db = $authManager->db;

        if($this->isMsSQL()) {
            $this->execute('DROP dbo.trigger_auth_item_child;');
        }

        $this->dropTable($authManager->assignmentTable);
        $this->dropTable($authManager->itemChildTable);
        $this->dropTable($authManager->itemTable);
        $this->dropTable($authManager->ruleTable);
    }
    /**
    * create permission
    * @author Praveen Kumar <praveen@makeubig.com>
    */
    protected function createPermission() 
    {
        $auth = Yii::$app->authManager;

        /**
         *              DASHBOARD PERMISSIONS
         */
        $indexd = $auth->createPermission('dashboard/index');
        $indexd->description = 'index dashboard';
        $auth->add($indexd);

        $created = $auth->createPermission('dashboard/create');
        $created->description = 'create dashboard';
        $auth->add($created);
        
        $updated = $auth->createPermission('dashboard/update');
        $updated->description = 'update dashboard';
        $auth->add($updated);
        
        $viewd = $auth->createPermission('dashboard/view');
        $viewd->description = 'view dashboard';
        $auth->add($viewd);
        
        $deleted = $auth->createPermission('dashboard/delete');
        $deleted->description = 'delete dashboard';
        $auth->add($deleted);

        
        /**
         *              USERS PERMISSIONS
         */
        $indexu = $auth->createPermission('user/index');
        $indexu->description = 'index user';
        $auth->add($indexu);

        $createu = $auth->createPermission('user/create');
        $createu->description = 'create user';
        $auth->add($createu);
        
        $updateu = $auth->createPermission('user/update');
        $updateu->description = 'update user';
        $auth->add($updateu);
        
        $viewu = $auth->createPermission('user/view');
        $viewu->description = 'view user';
        $auth->add($viewu);
        
        $deleteu = $auth->createPermission('user/delete');
        $deleteu->description = 'delete user';
        $auth->add($deleteu);

        /**
         *              PATIENT PERMISSIONS
         */

        $indexp = $auth->createPermission('patient/index');
        $indexp->description = 'index patient';
        $auth->add($indexp);

        $createp = $auth->createPermission('patient/create');
        $createp->description = 'create patient';
        $auth->add($createp);
        
        $updatep = $auth->createPermission('patient/update');
        $updatep->description = 'update patient';
        $auth->add($updatep);
        
        $viewp = $auth->createPermission('patient/view');
        $viewp->description = 'view patient';
        $auth->add($viewp);
        
        $deletep = $auth->createPermission('patient/delete');
        $deletep->description = 'delete patient';
        $auth->add($deletep);

        /**
         *              REPORT PERMISSIONS
         */
        $indexRep = $auth->createPermission('report/index');
        $indexRep->description = 'index report';
        $auth->add($indexRep);

        $createRep = $auth->createPermission('report/create');
        $createRep->description = 'create report';
        $auth->add($createRep);
        
        $updateRep = $auth->createPermission('report/update');
        $updateRep->description = 'update report';
        $auth->add($updateRep);
        
        $viewRep = $auth->createPermission('report/view');
        $viewRep->description = 'view report';
        $auth->add($viewRep);
        
        $deleteRep = $auth->createPermission('report/delete');
        $deleteRep->description = 'delete report';
        $auth->add($deleteRep);

        //                     AUTH

        $indexa = $auth->createPermission('auth');
        $indexa->description = 'Auth Access';
        $auth->add($indexa);
    }

    /**
    * create role
    * @author Praveen Kumar <praveen@makeubig.com>
    */
    protected function createRole() 
    {
        $auth = Yii::$app->authManager;
        //admin -> Own view/update
        //superadmin -> (admin) and -> view/update/create/index/delete
        
        $indexd = $auth->createPermission('dashboard/index');
        $created = $auth->createPermission('dashboard/create');
        $updated = $auth->createPermission('dashboard/update');
        $viewd = $auth->createPermission('dashboard/view');
        $deleted = $auth->createPermission('dashboard/delete');

        $indexu = $auth->createPermission('user/index');
        $createu = $auth->createPermission('user/create');
        $updateu = $auth->createPermission('user/update');
        $viewu = $auth->createPermission('user/view');
        $deleteu = $auth->createPermission('user/delete');

        $indexp = $auth->createPermission('patient/index');
        $createp = $auth->createPermission('patient/create');
        $updatep = $auth->createPermission('patient/update');
        $viewp = $auth->createPermission('patient/view');
        $deletep = $auth->createPermission('patient/delete');

        $indexRep = $auth->createPermission('report/index');
        $createRep = $auth->createPermission('report/create');
        $updateRep = $auth->createPermission('report/update');
        $viewRep = $auth->createPermission('report/view');
        $deleteRep = $auth->createPermission('report/delete');

        $indexa = $auth->createPermission('auth');  

        $subadmin = $auth->createRole('subadmin');
        $auth->add($subadmin);
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $subadmin);
        $auth->addChild($admin, $indexa);
        
        $superadmin = $auth->createRole('mubadmin');
        $auth->add($superadmin);
        $auth->addChild($superadmin, $admin);
        $auth->addChild($superadmin, $indexd);
        $auth->addChild($superadmin, $created);
        $auth->addChild($superadmin, $deleted);
        $auth->addChild($superadmin, $updated);
        $auth->addChild($superadmin, $viewd);
        $auth->addChild($superadmin, $indexu);
        $auth->addChild($superadmin, $createu);
        $auth->addChild($superadmin, $deleteu);
        $auth->addChild($superadmin, $updateu);
        $auth->addChild($superadmin, $viewu);
        $auth->addChild($superadmin, $indexp);
        $auth->addChild($superadmin, $createp);
        $auth->addChild($superadmin, $deletep);
        $auth->addChild($superadmin, $updatep);
        $auth->addChild($superadmin, $viewp);

        $auth->addChild($admin, $indexd);
        $auth->addChild($admin, $created);
        $auth->addChild($admin, $deleted);
        $auth->addChild($admin, $updated);
        $auth->addChild($admin, $viewd);
        $auth->addChild($admin, $indexu);
        $auth->addChild($admin, $createu);
        $auth->addChild($admin, $deleteu);
        $auth->addChild($admin, $updateu);
        $auth->addChild($admin, $viewu);
        $auth->addChild($admin, $indexp);
        $auth->addChild($admin, $createp);
        $auth->addChild($admin, $deletep);
        $auth->addChild($admin, $updatep);
        $auth->addChild($admin, $viewp);
        $auth->addChild($admin, $indexRep);
        $auth->addChild($admin, $createRep);
        $auth->addChild($admin, $updateRep);
        $auth->addChild($admin, $viewRep);
        $auth->addChild($admin, $deleteRep);

        $auth->addChild($subadmin, $indexd);
        $auth->addChild($subadmin, $created);
        $auth->addChild($subadmin, $deleted);
        $auth->addChild($subadmin, $updated);
        $auth->addChild($subadmin, $viewd);
    }
    /**
    * create user rule
    * @author Praveen Kumar <praveen@makeubig.com>
    */
    protected function createDashboardRule() 
    {
        $auth = Yii::$app->authManager;
        // add the rule
        $rule = new \app\components\rbac\AdminUserRule();
        $auth->add($rule);

        // add the "updateOwnUser" permission and associate the rule with it.
        $updateOwnUser = $auth->createPermission('updateOwnUser');
        $updateOwnUser->description = 'Update own User';
        $updateOwnUser->ruleName = $rule->name;
        $auth->add($updateOwnUser);

        $updatePost = $auth->createPermission('dashboard/update');
        // "updateOwnPost" will be used from "updatePost"
        $auth->addChild($updateOwnUser, $updatePost);

        $admin = $auth->createPermission('admin');
        // allow "author" to update their own posts
        $auth->addChild($admin, $updateOwnUser);
        
        // add the "viewOwnuser" permission and associate the rule with it.
        $viewOwnUser = $auth->createPermission('viewOwnUser');
        $viewOwnUser->description = 'View own User';
        $viewOwnUser->ruleName = $rule->name;
        $auth->add($viewOwnUser);

        $viewPost = $auth->createPermission('dashboard/view');
        // "updateOwnPost" will be used from "updatePost"
        $auth->addChild($viewOwnUser, $viewPost);
        $auth->addChild($admin, $viewOwnUser);
    }

    /**
    * assign role
    * @author Praveen Kumar <praveen@makeubig.com>
    */
    protected function assignRole()
    {
        $auth = Yii::$app->authManager;
        
        $superadmin = $auth->createRole('mubadmin');
        $auth->assign($superadmin, 1);
        
        $admin = $auth->createRole('admin');
        $user = \app\models\User::find()->all();
        foreach ($user as $key => $value) 
        {
            if($value->id > 1)
            {
                $auth->assign($admin, $value->id);
            }
        }
    }
}