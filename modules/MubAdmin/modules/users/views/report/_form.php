<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PatientReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'patient_id')->textInput() ?>

    <?= $form->field($model, 'lab_id')->textInput() ?>

    <?= $form->field($model, 'mub_user_id')->textInput() ?>

    <?= $form->field($model, 'haemoglobin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_leucocyte_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'red_blood_cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'packed_cell_volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mean_corpuscular_volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'esr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mean_corpusular_hb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mean_corpusular_hb_conc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mean_platelets_volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hemoglobin_distribution_width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'corpuscular_hemoglobin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chcm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'platelet_distribution_width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pct')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'platelet_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'neutrophils')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lymphocytes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monocytes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eosinophils')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'basophils')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'large_unstained_cells')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'red_cell_distribution_width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rdw_sd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'absolute_eosinophils_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'large_unstained_cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cholesterol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'triglycetides')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hdl_cholesterol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ldl_cholesterol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serum_vldl_cholesterol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'non_hdl_cholesterol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sedum_cholesterol_hdl_ratio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ldl_hdl_cholesterol_ratio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'urea')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blood_urea_nitrogen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creatinine_serum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uric_acid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'urea_creatinine_ratio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bun_creatinine_ratio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cystatin_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blood_ketone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ionized_calcium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_calcium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zinc_serum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mercury')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caesium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'beryllium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'arsenic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phosphorus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sodium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pottasium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chloride')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'magnesium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bilirubin_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bilirubin_direct')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bilirubin_indirect')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sgot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sgpt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alkaline_phosphatase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ggtp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iron_serum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serum_total_proteins')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serum_albumin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serum_globulin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'globulin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pancreatic_alfa_amylase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'immunogloublin_igg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'immunogloublin_igm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'immunogloublin_ige')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'immunogloublin_iga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iron')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_iron_binding')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transfeerrin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transferrin_saturation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unsaturated_iron_binding')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ferritin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'free_trijodothyronine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'free_thyroxine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'report_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'del_status')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
