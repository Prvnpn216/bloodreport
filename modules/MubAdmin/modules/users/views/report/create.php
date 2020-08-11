<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PatientReport */

$this->title = 'Create Patient Report';
$this->params['breadcrumbs'][] = ['label' => 'Patient Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
