<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MubUser */

$this->title = Yii::t('app', 'Create Web User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mub Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default col-md-10 col-md-offset-1 col-sm-12"><!--pannel-->
<h3 class="panel-heading"><?= Html::encode($this->title) ?></h3>
<div class="mub-user-create">


    <?= $this->render('_form', [
        'mubUser' => $mubUser,
        'allStates' => $allStates
    ]) ?>

</div>