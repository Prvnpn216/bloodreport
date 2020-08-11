<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\City;
?>

<div class="mub-user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6">
        <?= $form->field($mubUser, 'email')->textInput();?>
    </div>
    
    <div class="col-md-6">
        <?= $form->field($mubUser, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($mubUser, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($mubUser, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other', ], ['prompt' => '']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($mubUser, 'dob')->textInput() ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($mubUser, 'username')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($mubUser, 'password')->passwordInput(['maxlength' => true]);?>
    </div>
    <div class="col-md-6">
        <?= $form->field($mubUser, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => 'Select A Status']) ?>
    </div>
    <div class="form-group col-md-1" style="text-align:left">
        <?= Html::submitButton($mubUser->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $mubUser->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>