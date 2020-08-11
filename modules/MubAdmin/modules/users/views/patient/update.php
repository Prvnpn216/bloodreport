<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = 'Update Patient: ' . $patient->name;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $patient->name, 'url' => ['view', 'id' => $patient->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel panel-default col-md-6 col-md-offset-3 col-sm-6"><!--pannel-->
  <h3 class="panel-heading"><?= Html::encode($this->title) ?></h3>
<div class="patient-update">

    

    <?= $this->render('_form', [
        'patient' => $patient,
    ]) ?>

</div>
