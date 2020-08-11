<?php

namespace app\components;
use \yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\models\AuthAssignment;
use yii\db\Expression;
use Yii;

abstract class Model extends ActiveRecord
{
     
	public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    public function getAll($fieldName)
    {
      $all =  $this->find()->where(['del_status' => '0'])->all();
        $vals = [];
        foreach ($all as $val) {
            $vals[$val->id] = $val->$fieldName;
        }
        return $vals;  
    }

    public function getManyById($id,$compareField,$getField)
    {
        $all =  $this->find()->where([$compareField => $id,'del_status' => '0'])->all();
        $vals = [];
        foreach ($all as $val) {
            $vals[$val->id] = $val->$getField;
        }
        return $vals;
    }

    public function getAllByValue($field,$value)
    {

    }

    public static function getAuthRole() {
        $user_id = Yii::$app->user->id;
        $getid = AuthAssignment::find()->where(['user_id' => $user_id])->one();
        return $getid['item_name'];
    }
}
