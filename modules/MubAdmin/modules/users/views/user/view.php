<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $mubUser app\models\MubUser */

$this->title = $mubUser->first_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Web Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mub-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $mubUser->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $mubUser->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $mubUser,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'gender',
            'dob',
            // ['attribute' => 'Email',
            // 'value' => $mubUserContacts->email],
            'username',
            'created_at',
            'status',
        ],
    ]) ?>

</div>