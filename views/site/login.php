<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <div id="login-container" class="login_wrapper">
      <div id="login" class="animate form login_form">
        <section class="login_content">
          <?php $form = ActiveForm::begin([
              'id' => 'login-form'
              ]); ?>
            <h1><?= Html::encode($this->title) ?></h1>
              <?= $form->field($model, 'username')->textInput(['autofocus' => true,'class' => 'form-control']);?>
              <?= $form->field($model, 'password')->passwordInput();?>
            <div>
            <?= $form->field($model, 'rememberMe')->checkbox([
          'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>"]) ?>
            </div>
            <div>
            <?= Html::submitButton('Login', ['class' => 'btn btn-default submit', 'name' => 'login-button']);?>
              <!--<a class="reset_pass" href="#">Forget password?</a>-->
            </div>
            <div class="clearfix"></div>
            <div class="separator">
             <!-- <p class="change_link">New to site?
                <a href="/site/register" class="to_register">Create Account </a>
              </p>-->
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><img src="/images/appicon.png" width="50px" height="50px">Gagan Pratap App</h1>
                <p>©<?=date('Y',time());?> All Rights Reserved. Privacy and Terms</p>
              </div>
            </div>
          <?php ActiveForm::end(); ?>
        </section>
      </div>
    </div>
  </div>
</div>