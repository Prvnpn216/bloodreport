<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $city_name
 * @property integer $state_id
 * @property string $region_id
 * @property integer $order_by
 * @property integer $pin_code
 *
 * @property State $state
 * @property MubUserContact[] $mubUserContacts
 */
class City extends \app\components\Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state_id'], 'required'],
            [['state_id', 'order_by', 'pin_code'], 'integer'],
            [['city_name'], 'string', 'max' => 100],
            [['region_id'], 'string', 'max' => 5],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'city_name' => Yii::t('app', 'City Name'),
            'state_id' => Yii::t('app', 'State ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'order_by' => Yii::t('app', 'Order By'),
            'pin_code' => Yii::t('app', 'Pin Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id'])->where(['del_status' => '0']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMubUserContacts()
    {
        return $this->hasMany(MubUserContact::className(), ['city' => 'id'])->where(['del_status' => '0']);
    }

    /**
     * @inheritdoc
     * @return StateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StateQuery(get_called_class());
    }
}
