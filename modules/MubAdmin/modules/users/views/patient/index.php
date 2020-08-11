<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default col-md-10 col-md-offset-1 col-sm-12"><!--pannel-->
    <h3 class="panel-heading"><?= Html::encode($this->title) ?></h3>
<div class="patient-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Patient', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'mobile',
            'address:ntext',
            //'clinic_name',
            //'created_at',
            //'updated_at',
            //'status',
            //'del_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
