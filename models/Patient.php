<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $address
 * @property string $clinic_name
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 * @property string $del_status 0-Active,1-Deleted DEFAULT 0
 *
 * @property PatientReport[] $patientReports
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'mobile'], 'required'],
            [['address', 'status', 'del_status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['email', 'clinic_name'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 20],
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
            'email' => 'Email',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'clinic_name' => 'Clinic Name',
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
        return $this->hasMany(PatientReport::className(), ['patient_id' => 'id']);
    }
}
