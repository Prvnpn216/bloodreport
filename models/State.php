<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property integer $id
 * @property string $state_name
 * @property string $created_at
 * @property string $updated_at
 * @property string $del_status
 *
 * @property City[] $cities
 */
class State extends \app\components\Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['del_status'], 'string'],
            [['state_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'state_name' => Yii::t('app', 'State Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'del_status' => Yii::t('app', 'Del Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['state_id' => 'id'])->where(['del_status' => '0']);
    }

    public function getAllStates(){
        $allStates = $this->find()->all();
        $stateList = [];
        foreach ($allStates as $key => $state) {
            $stateList[$state['id']] = $state['state_name'];
        }
        return $stateList;
    }   
}
