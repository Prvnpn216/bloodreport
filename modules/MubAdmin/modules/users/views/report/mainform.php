<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PatientReport */
/* @var $form yii\widgets\ActiveForm */
?><div>
 

<div class="patient-report-form">
     <iframe src="/uploads/SANJEEVANI.PDF" style="height: 100%; width: 45%; position: fixed; margin-left: 43%;">
 </iframe>
    <div class="panel panel-default col-md-6 col-sm-6">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($report, 'patient_id')->textInput() ?>

    <?= $form->field($report, 'lab_id')->textInput() ?>

    <?= $form->field($report, 'mub_user_id')->textInput() ?>

    <?= $form->field($report, 'haemoglobin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'total_leucocyte_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'red_blood_cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'packed_cell_volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'mean_corpuscular_volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'esr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'mean_corpusular_hb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'mean_corpusular_hb_conc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'mean_platelets_volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'hemoglobin_distribution_width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'corpuscular_hemoglobin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'chcm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'platelet_distribution_width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'pct')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'platelet_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'neutrophils')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'lymphocytes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'monocytes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'eosinophils')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'basophils')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'large_unstained_cells')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'red_cell_distribution_width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'rdw_sd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'absolute_eosinophils_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'large_unstained_cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'cholesterol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'triglycetides')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'hdl_cholesterol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'ldl_cholesterol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'serum_vldl_cholesterol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'non_hdl_cholesterol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'sedum_cholesterol_hdl_ratio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'ldl_hdl_cholesterol_ratio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'urea')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'blood_urea_nitrogen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'creatinine_serum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'uric_acid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'urea_creatinine_ratio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'bun_creatinine_ratio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'cystatin_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'blood_ketone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'ionized_calcium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'total_calcium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'zinc_serum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'mercury')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'caesium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'beryllium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'arsenic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'phosphorus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'sodium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'pottasium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'chloride')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'magnesium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'bilirubin_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'bilirubin_direct')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'bilirubin_indirect')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'sgot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'sgpt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'alkaline_phosphatase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'ggtp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'iron_serum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'serum_total_proteins')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'serum_albumin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'serum_globulin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'globulin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'pancreatic_alfa_amylase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'cpk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'immunogloublin_igg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'immunogloublin_igm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'immunogloublin_ige')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'immunogloublin_iga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'iron')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'total_iron_binding')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'transfeerrin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'transferrin_saturation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'unsaturated_iron_binding')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'ferritin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'free_trijodothyronine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'free_thyroxine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($report, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <?= $form->field($report, 'report_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($report, 'created_at')->textInput() ?>

    <?= $form->field($report, 'updated_at')->textInput() ?>

    <?= $form->field($report, 'del_status')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>