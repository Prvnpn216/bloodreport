<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = 'Update Patient: ' . $patient->name;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $patient->name, 'url' => ['view', 'id' => $patient->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="patient-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'patient' => $patient,
    ]) ?>

</div>
