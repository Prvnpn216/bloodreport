<?php
namespace backend\globe\base\rbac;

use yii\rbac\Rule;

/**
 * Checks if userid matches user passed via params
 * @author Sujit Verma <sujit.verma@girnarsoft.com>
 */
class AdminBuyleadRule extends Rule
{
    public $name = 'isAdminBuylead';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $id = \Yii::$app->request->get('id');
        if(!empty($id))
        {
            $model = \common\models\CustomerDealerMapping::findOne($id);
            return $model->dealer->user_id == $user;
        }
        elseif(getAuthRole() == 'admin')
        {
            return true;
        }
    }
}

