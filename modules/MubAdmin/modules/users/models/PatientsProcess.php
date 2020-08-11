<?php
namespace app\modules\MubAdmin\modules\users\models;
use app\components\Model;
use app\helpers\HtmlHelper;
use app\models\MubUser;
use app\models\Patient;

class PatientsProcess extends Model
{
	public $models = [];
    public $deps = [];
    public $relatedModels = [];
    
    public function getModels()
    {
        $patient = new Patient(); 
        $this->models = [
            'patient' => $patient
        ];
        return $this->models;
    }

    public function getFormData()
    {
        return [];
    }

    public function getRelatedModels($model)
    {
        $patient = $model;
        $this->relatedModels = [
            'patient' => $patient
        ];
        return $this->relatedModels;
    }

    public function savePatient($patient){
    	return ($patient->save())? $patient->id : false;
    }

    public function saveData($data)
    {
    	if (isset($data['patient']))
        {
        try {
                $patient = $this->savePatient($data['patient']);
                if($patient)
                {
                    return $patient;    
                } 
                else
                {
                    throw new \yii\web\HttpException(500, 'Patient data not saved');
                } 
            }
            catch (\Exception $e)
            {
                throw $e;
            }
        } 
        else
        {
            throw new \yii\web\HttpException(500, 'Model Not Loaded properly');
        }
    }

}