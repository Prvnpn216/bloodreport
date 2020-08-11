<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PatientReportsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($report, 'id') ?>

    <?= $form->field($report, 'patient_id') ?>

    <?= $form->field($report, 'lab_id') ?>

    <?= $form->field($report, 'mub_user_id') ?>

    <?= $form->field($report, 'haemoglobin') ?>

    <?php // echo $form->field($model, 'total_leucocyte_count') ?>

    <?php // echo $form->field($model, 'red_blood_cell') ?>

    <?php // echo $form->field($model, 'packed_cell_volume') ?>

    <?php // echo $form->field($model, 'mean_corpuscular_volume') ?>

    <?php // echo $form->field($model, 'esr') ?>

    <?php // echo $form->field($model, 'mean_corpusular_hb') ?>

    <?php // echo $form->field($model, 'mean_corpusular_hb_conc') ?>

    <?php // echo $form->field($model, 'mean_platelets_volume') ?>

    <?php // echo $form->field($model, 'hemoglobin_distribution_width') ?>

    <?php // echo $form->field($model, 'corpuscular_hemoglobin') ?>

    <?php // echo $form->field($model, 'chcm') ?>

    <?php // echo $form->field($model, 'platelet_distribution_width') ?>

    <?php // echo $form->field($model, 'pct') ?>

    <?php // echo $form->field($model, 'platelet_count') ?>

    <?php // echo $form->field($model, 'neutrophils') ?>

    <?php // echo $form->field($model, 'lymphocytes') ?>

    <?php // echo $form->field($model, 'monocytes') ?>

    <?php // echo $form->field($model, 'eosinophils') ?>

    <?php // echo $form->field($model, 'basophils') ?>

    <?php // echo $form->field($model, 'large_unstained_cells') ?>

    <?php // echo $form->field($model, 'red_cell_distribution_width') ?>

    <?php // echo $form->field($model, 'rdw_sd') ?>

    <?php // echo $form->field($model, 'absolute_eosinophils_count') ?>

    <?php // echo $form->field($model, 'large_unstained_cell') ?>

    <?php // echo $form->field($model, 'cholesterol') ?>

    <?php // echo $form->field($model, 'triglycetides') ?>

    <?php // echo $form->field($model, 'hdl_cholesterol') ?>

    <?php // echo $form->field($model, 'ldl_cholesterol') ?>

    <?php // echo $form->field($model, 'serum_vldl_cholesterol') ?>

    <?php // echo $form->field($model, 'non_hdl_cholesterol') ?>

    <?php // echo $form->field($model, 'sedum_cholesterol_hdl_ratio') ?>

    <?php // echo $form->field($model, 'ldl_hdl_cholesterol_ratio') ?>

    <?php // echo $form->field($model, 'urea') ?>

    <?php // echo $form->field($model, 'blood_urea_nitrogen') ?>

    <?php // echo $form->field($model, 'creatinine_serum') ?>

    <?php // echo $form->field($model, 'uric_acid') ?>

    <?php // echo $form->field($model, 'urea_creatinine_ratio') ?>

    <?php // echo $form->field($model, 'bun_creatinine_ratio') ?>

    <?php // echo $form->field($model, 'cystatin_c') ?>

    <?php // echo $form->field($model, 'blood_ketone') ?>

    <?php // echo $form->field($model, 'ionized_calcium') ?>

    <?php // echo $form->field($model, 'total_calcium') ?>

    <?php // echo $form->field($model, 'zinc_serum') ?>

    <?php // echo $form->field($model, 'mercury') ?>

    <?php // echo $form->field($model, 'caesium') ?>

    <?php // echo $form->field($model, 'beryllium') ?>

    <?php // echo $form->field($model, 'arsenic') ?>

    <?php // echo $form->field($model, 'phosphorus') ?>

    <?php // echo $form->field($model, 'sodium') ?>

    <?php // echo $form->field($model, 'pottasium') ?>

    <?php // echo $form->field($model, 'chloride') ?>

    <?php // echo $form->field($model, 'magnesium') ?>

    <?php // echo $form->field($model, 'bilirubin_total') ?>

    <?php // echo $form->field($model, 'bilirubin_direct') ?>

    <?php // echo $form->field($model, 'bilirubin_indirect') ?>

    <?php // echo $form->field($model, 'sgot') ?>

    <?php // echo $form->field($model, 'sgpt') ?>

    <?php // echo $form->field($model, 'alkaline_phosphatase') ?>

    <?php // echo $form->field($model, 'ggtp') ?>

    <?php // echo $form->field($model, 'iron_serum') ?>

    <?php // echo $form->field($model, 'serum_total_proteins') ?>

    <?php // echo $form->field($model, 'serum_albumin') ?>

    <?php // echo $form->field($model, 'serum_globulin') ?>

    <?php // echo $form->field($model, 'globulin') ?>

    <?php // echo $form->field($model, 'pancreatic_alfa_amylase') ?>

    <?php // echo $form->field($model, 'cpk') ?>

    <?php // echo $form->field($model, 'immunogloublin_igg') ?>

    <?php // echo $form->field($model, 'immunogloublin_igm') ?>

    <?php // echo $form->field($model, 'immunogloublin_ige') ?>

    <?php // echo $form->field($model, 'immunogloublin_iga') ?>

    <?php // echo $form->field($model, 'iron') ?>

    <?php // echo $form->field($model, 'total_iron_binding') ?>

    <?php // echo $form->field($model, 'transfeerrin') ?>

    <?php // echo $form->field($model, 'transferrin_saturation') ?>

    <?php // echo $form->field($model, 'unsaturated_iron_binding') ?>

    <?php // echo $form->field($model, 'ferritin') ?>

    <?php // echo $form->field($model, 'free_trijodothyronine') ?>

    <?php // echo $form->field($model, 'free_thyroxine') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'report_url') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'del_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
