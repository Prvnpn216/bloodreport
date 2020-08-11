<?php

namespace app\modules\MubAdmin\modules\users\controllers;

use Yii;
use app\models\PatientReport;
use app\models\PatientReportsSearch;
use app\modules\MubAdmin\modules\users\models\ReportProcess;
use app\components\MubController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReportController implements the CRUD actions for PatientReport model.
 */
class ReportController extends MubController
{ 
    public function getProcessModel()
    {
        return new ReportProcess();
    }

    public function getPrimaryModel()
    {
        return new PatientReport();
    }

    public function getSearchModel()
    {
        return new PatientReportsSearch();
    }
}
