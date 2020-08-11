<?php
namespace app\components\rbac;

use yii\rbac\Rule;

/**
 * Checks if userid matches user passed via params
 * @author Praveen Kumar <praveen@makeubig.com>
 */
class AdminUserRule extends Rule
{
    public $name = 'isAdminUser';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $id = \Yii::$app->request->get('id');
        $model = \app\models\User::findOne($id);
        return $model->id == $user;
    }
}

