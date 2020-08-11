<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AppUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'App Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default col-md-10 col-md-offset-1 col-sm-12"><!--pannel-->
     <h3 class="panel-heading"><?= Html::encode($this->title) ?></h3>
    
<div class="app-user-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            // 'password',
            'mobile',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    $userRole = \Yii::$app->controller->getUserRole();
                    if($userRole == 'admin'){
                        $modelName = str_replace('\\','\\\\',get_class($model));
                    $attrib = 'status'; 
                    $valActive = 'Active';
                    $id = $model->id;
                    $valInactive = 'Inactive';
                    return ($model->status == 'Inactive') ? '<button class="btn btn-primary" onClick="setModelAttribute('.'\''.$modelName.'\''.','.'\''.$attrib.'\''.','.'\''.$valActive.'\''.','.'\''.$id.'\''.')">Activate</button>' : '<button class="btn btn-danger" onClick="setModelAttribute('.'\''.$modelName.'\''.','.'\''.$attrib.'\''.','.'\''.$valInactive.'\''.','.'\''.$id.'\''.')">Deactivate</button>';    
                    }
                    else
                    {
                        return $model->status;
                    }
                    
                },
            ]
            //'otp',
            //'verified',
            //'access_token:ntext',
            //'image:ntext',
            //'created_at',
            //'updated_at',
            //'status',
            //'del_status',
        ],
    ]); ?>
    </div></div>
