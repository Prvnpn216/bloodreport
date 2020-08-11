<?php
namespace app\modules\MubAdmin\modules\users\controllers;
use Yii;
use app\models\Patient;
use app\models\PatientsSearch;
use app\components\MubController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\MubAdmin\modules\users\models\PatientsProcess;

/**
 * PatientsController implements the CRUD actions for Patient model.
 */
class PatientController extends MubController
{
    public function getProcessModel()
    {
        return new PatientsProcess();
    }

    public function getPrimaryModel()
    {
        return new Patient();
    }

    public function getSearchModel()
    {
        return new PatientsSearch();
    }
}
