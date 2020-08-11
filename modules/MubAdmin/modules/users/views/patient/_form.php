<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($patient, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($patient, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($patient, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($patient, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($patient, 'clinic_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
