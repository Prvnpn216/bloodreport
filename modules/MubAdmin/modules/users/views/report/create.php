<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PatientReport */

$this->title = 'Upload Patient Report';
$this->params['breadcrumbs'][] = ['label' => 'Patient Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

   
<div class="patient-report-create">
<h3 class="panel-heading"><?= Html::encode($this->title) ?></h3>   
  

    <?= $this->render('_form', [
        'report' => $report,
    ]) ?>

</div>
