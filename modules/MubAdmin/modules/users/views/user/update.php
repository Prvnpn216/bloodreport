<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $mubUser app\models\MubUser */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . $mubUser->first_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mub Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $mubUser->first_name, 'url' => ['view', 'id' => $mubUser->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="panel panel-default col-md-10 col-md-offset-1 col-sm-12"><!--pannel-->
<h3 class="panel-heading"><?= Html::encode($this->title) ?></h3>
<div class="mub-user-update">
   

    <?= $this->render('_form', [
        'mubUser' => $mubUser,
        'allStates' => $allStates
    ]) ?>

</div>