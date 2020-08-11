<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lab".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 * @property string $del_status 0-Active,1-Deleted DEFAULT 0
 *
 * @property PatientReport[] $patientReports
 */
class Lab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['address', 'status', 'del_status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'del_status' => 'Del Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientReports()
    {
        return $this->hasMany(PatientReport::className(), ['lab_id' => 'id']);
    }
}
