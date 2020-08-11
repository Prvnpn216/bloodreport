<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;

$this->title = 'Register';
?>
<div class="login">
<div class="login_wrapper">
<div id="register" class="animate form">
  <section class="login_content">
    <?php $form = ActiveForm::begin([ 'id' => 'login-form']); ?>
      <h1>Create Account</h1>
        <?= $form->field($model, 'first_name')->textInput(['autofocus' => true,'class' => 'form-control','placeholder' => 'First Name'])->label(false);?>
          <?= $form->field($model, 'last_name')->textInput(['class' => 'form-control','placeholder' => 'Last Name'])->label(false);?>
          <?= $form->field($model, 'email')->textInput(['class' => 'form-control','placeholder' => 'Email'])->label(false);?>
        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control','placeholder' => 'Password'])->label(false);?>
        <?= $form->field($model, 'password_confirm')->passwordInput(['class' => 'form-control','placeholder' => 'Confirm Password'])->label(false);?>
      <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="reset" class="btn btn-primary">Cancel</button>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
      <div class="clearfix"></div>

      <div class="separator">
        <p class="change_link">Already a member ?
          <a href="#signin" class="to_register"> Log in </a>
        </p>

        <div class="clearfix"></div>
        <br>

        <div>
          <h1><img src="/images/appicon.png" width="50px" height="50px" />Gagan Pratap App</h1>
          <p>©2016 All Rights Reserved. <!--<a href="http://makeubig.com" rel="nofollow" target="_blank">M</a></p>-->
        </div>
      </div>
    <?php ActiveForm::end(); ?>
  </section>
</div>
</div>
</div>