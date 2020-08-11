<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PatientReport */

$this->title = 'Update Patient Report: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Patient Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel panel-default col-md-6 col-md-offset-3 col-sm-6"><!--pannel-->
  <h3 class="panel-heading"><?= Html::encode($this->title) ?></h3>   
<div class="patient-report-update">

 

    <?= $this->render('_form', [
        'report' => $report,
    ]) ?>

</div>
