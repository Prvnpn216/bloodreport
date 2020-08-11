<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PatientReport */

$this->title = 'Create Patient Report';
$this->params['breadcrumbs'][] = ['label' => 'Patient Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default col-md-6 col-md-offset-3 col-sm-6"><!--pannel-->
  <h3 class="panel-heading"><?= Html::encode($this->title) ?></h3>   
<div class="patient-report-create">

  

    <?= $this->render('_form', [
        'report' => $report,
    ]) ?>

</div>
