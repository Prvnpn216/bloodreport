<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientReportsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Patient Report', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'patient_id',
            'lab_id',
            'mub_user_id',
            'haemoglobin',
            //'total_leucocyte_count',
            //'red_blood_cell',
            //'packed_cell_volume',
            //'mean_corpuscular_volume',
            //'esr',
            //'mean_corpusular_hb',
            //'mean_corpusular_hb_conc',
            //'mean_platelets_volume',
            //'hemoglobin_distribution_width',
            //'corpuscular_hemoglobin',
            //'chcm',
            //'platelet_distribution_width',
            //'pct',
            //'platelet_count',
            //'neutrophils',
            //'lymphocytes',
            //'monocytes',
            //'eosinophils',
            //'basophils',
            //'large_unstained_cells',
            //'red_cell_distribution_width',
            //'rdw_sd',
            //'absolute_eosinophils_count',
            //'large_unstained_cell',
            //'cholesterol',
            //'triglycetides',
            //'hdl_cholesterol',
            //'ldl_cholesterol',
            //'serum_vldl_cholesterol',
            //'non_hdl_cholesterol',
            //'sedum_cholesterol_hdl_ratio',
            //'ldl_hdl_cholesterol_ratio',
            //'urea',
            //'blood_urea_nitrogen',
            //'creatinine_serum',
            //'uric_acid',
            //'urea_creatinine_ratio',
            //'bun_creatinine_ratio',
            //'cystatin_c',
            //'blood_ketone',
            //'ionized_calcium',
            //'total_calcium',
            //'zinc_serum',
            //'mercury',
            //'caesium',
            //'beryllium',
            //'arsenic',
            //'phosphorus',
            //'sodium',
            //'pottasium',
            //'chloride',
            //'magnesium',
            //'bilirubin_total',
            //'bilirubin_direct',
            //'bilirubin_indirect',
            //'sgot',
            //'sgpt',
            //'alkaline_phosphatase',
            //'ggtp',
            //'iron_serum',
            //'serum_total_proteins',
            //'serum_albumin',
            //'serum_globulin',
            //'globulin',
            //'pancreatic_alfa_amylase',
            //'cpk',
            //'immunogloublin_igg',
            //'immunogloublin_igm',
            //'immunogloublin_ige',
            //'immunogloublin_iga',
            //'iron',
            //'total_iron_binding',
            //'transfeerrin',
            //'transferrin_saturation',
            //'unsaturated_iron_binding',
            //'ferritin',
            //'free_trijodothyronine',
            //'free_thyroxine',
            //'status',
            //'report_url:ntext',
            //'created_at',
            //'updated_at',
            //'del_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
