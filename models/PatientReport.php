<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient_report".
 *
 * @property int $id
 * @property int $patient_id
 * @property int $lab_id
 * @property int $mub_user_id
 * @property string $haemoglobin
 * @property string $total_leucocyte_count
 * @property string $red_blood_cell
 * @property string $packed_cell_volume
 * @property string $mean_corpuscular_volume
 * @property string $esr
 * @property string $mean_corpusular_hb
 * @property string $mean_corpusular_hb_conc
 * @property string $mean_platelets_volume
 * @property string $hemoglobin_distribution_width
 * @property string $corpuscular_hemoglobin
 * @property string $chcm
 * @property string $platelet_distribution_width
 * @property string $pct
 * @property string $platelet_count
 * @property string $neutrophils
 * @property string $lymphocytes
 * @property string $monocytes
 * @property string $eosinophils
 * @property string $basophils
 * @property string $large_unstained_cells
 * @property string $red_cell_distribution_width
 * @property string $rdw_sd
 * @property string $absolute_eosinophils_count
 * @property string $large_unstained_cell
 * @property string $cholesterol
 * @property string $triglycetides
 * @property string $hdl_cholesterol
 * @property string $ldl_cholesterol
 * @property string $serum_vldl_cholesterol
 * @property string $non_hdl_cholesterol
 * @property string $sedum_cholesterol_hdl_ratio
 * @property string $ldl_hdl_cholesterol_ratio
 * @property string $urea
 * @property string $blood_urea_nitrogen
 * @property string $creatinine_serum
 * @property string $uric_acid
 * @property string $urea_creatinine_ratio
 * @property string $bun_creatinine_ratio
 * @property string $cystatin_c
 * @property string $blood_ketone
 * @property string $ionized_calcium
 * @property string $total_calcium
 * @property string $zinc_serum
 * @property string $mercury
 * @property string $caesium
 * @property string $beryllium
 * @property string $arsenic
 * @property string $phosphorus
 * @property string $sodium
 * @property string $pottasium
 * @property string $chloride
 * @property string $magnesium
 * @property string $bilirubin_total
 * @property string $bilirubin_direct
 * @property string $bilirubin_indirect
 * @property string $sgot
 * @property string $sgpt
 * @property string $alkaline_phosphatase
 * @property string $ggtp
 * @property string $iron_serum
 * @property string $serum_total_proteins
 * @property string $serum_albumin
 * @property string $serum_globulin
 * @property string $globulin
 * @property string $pancreatic_alfa_amylase
 * @property string $cpk
 * @property string $immunogloublin_igg
 * @property string $immunogloublin_igm
 * @property string $immunogloublin_ige
 * @property string $immunogloublin_iga
 * @property string $iron
 * @property string $total_iron_binding
 * @property string $transfeerrin
 * @property string $transferrin_saturation
 * @property string $unsaturated_iron_binding
 * @property string $ferritin
 * @property string $free_trijodothyronine
 * @property string $free_thyroxine
 * @property string $status
 * @property string $report_url
 * @property string $created_at
 * @property string $updated_at
 * @property string $del_status 0-Active,1-Deleted DEFAULT 0
 *
 * @property Lab $lab
 * @property MubUser $mubUser
 * @property Patient $patient
 */
class PatientReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patient_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['patient_id', 'lab_id', 'mub_user_id'], 'required'],
            [['patient_id', 'lab_id', 'mub_user_id'], 'integer'],
            [['status', 'report_url', 'del_status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['haemoglobin', 'total_leucocyte_count', 'red_blood_cell', 'packed_cell_volume', 'mean_corpuscular_volume', 'esr', 'mean_corpusular_hb', 'mean_corpusular_hb_conc', 'mean_platelets_volume', 'hemoglobin_distribution_width', 'corpuscular_hemoglobin', 'chcm', 'platelet_distribution_width', 'pct', 'platelet_count', 'neutrophils', 'lymphocytes', 'monocytes', 'eosinophils', 'basophils', 'large_unstained_cells', 'red_cell_distribution_width', 'rdw_sd', 'absolute_eosinophils_count', 'large_unstained_cell', 'cholesterol', 'triglycetides', 'hdl_cholesterol', 'ldl_cholesterol', 'serum_vldl_cholesterol', 'non_hdl_cholesterol', 'sedum_cholesterol_hdl_ratio', 'ldl_hdl_cholesterol_ratio', 'urea', 'blood_urea_nitrogen', 'creatinine_serum', 'uric_acid', 'urea_creatinine_ratio', 'bun_creatinine_ratio', 'cystatin_c', 'blood_ketone', 'ionized_calcium', 'total_calcium', 'zinc_serum', 'mercury', 'caesium', 'beryllium', 'arsenic', 'phosphorus', 'sodium', 'pottasium', 'chloride', 'magnesium', 'bilirubin_total', 'bilirubin_direct', 'bilirubin_indirect', 'sgot', 'sgpt', 'alkaline_phosphatase', 'ggtp', 'iron_serum', 'serum_total_proteins', 'serum_albumin', 'serum_globulin', 'globulin', 'pancreatic_alfa_amylase', 'cpk', 'immunogloublin_igg', 'immunogloublin_igm', 'immunogloublin_ige', 'immunogloublin_iga', 'iron', 'total_iron_binding', 'transfeerrin', 'transferrin_saturation', 'unsaturated_iron_binding', 'ferritin', 'free_trijodothyronine', 'free_thyroxine'], 'string', 'max' => 255],
            [['lab_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lab::className(), 'targetAttribute' => ['lab_id' => 'id']],
            [['mub_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => MubUser::className(), 'targetAttribute' => ['mub_user_id' => 'id']],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::className(), 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'patient_id' => 'Patient ID',
            'lab_id' => 'Lab ID',
            'mub_user_id' => 'Mub User ID',
            'haemoglobin' => 'Haemoglobin',
            'total_leucocyte_count' => 'Total Leucocyte Count',
            'red_blood_cell' => 'Red Blood Cell',
            'packed_cell_volume' => 'Packed Cell Volume',
            'mean_corpuscular_volume' => 'Mean Corpuscular Volume',
            'esr' => 'Esr',
            'mean_corpusular_hb' => 'Mean Corpusular Hb',
            'mean_corpusular_hb_conc' => 'Mean Corpusular Hb Conc',
            'mean_platelets_volume' => 'Mean Platelets Volume',
            'hemoglobin_distribution_width' => 'Hemoglobin Distribution Width',
            'corpuscular_hemoglobin' => 'Corpuscular Hemoglobin',
            'chcm' => 'Chcm',
            'platelet_distribution_width' => 'Platelet Distribution Width',
            'pct' => 'Pct',
            'platelet_count' => 'Platelet Count',
            'neutrophils' => 'Neutrophils',
            'lymphocytes' => 'Lymphocytes',
            'monocytes' => 'Monocytes',
            'eosinophils' => 'Eosinophils',
            'basophils' => 'Basophils',
            'large_unstained_cells' => 'Large Unstained Cells',
            'red_cell_distribution_width' => 'Red Cell Distribution Width',
            'rdw_sd' => 'Rdw Sd',
            'absolute_eosinophils_count' => 'Absolute Eosinophils Count',
            'large_unstained_cell' => 'Large Unstained Cell',
            'cholesterol' => 'Cholesterol',
            'triglycetides' => 'Triglycetides',
            'hdl_cholesterol' => 'Hdl Cholesterol',
            'ldl_cholesterol' => 'Ldl Cholesterol',
            'serum_vldl_cholesterol' => 'Serum Vldl Cholesterol',
            'non_hdl_cholesterol' => 'Non Hdl Cholesterol',
            'sedum_cholesterol_hdl_ratio' => 'Sedum Cholesterol Hdl Ratio',
            'ldl_hdl_cholesterol_ratio' => 'Ldl Hdl Cholesterol Ratio',
            'urea' => 'Urea',
            'blood_urea_nitrogen' => 'Blood Urea Nitrogen',
            'creatinine_serum' => 'Creatinine Serum',
            'uric_acid' => 'Uric Acid',
            'urea_creatinine_ratio' => 'Urea Creatinine Ratio',
            'bun_creatinine_ratio' => 'Bun Creatinine Ratio',
            'cystatin_c' => 'Cystatin C',
            'blood_ketone' => 'Blood Ketone',
            'ionized_calcium' => 'Ionized Calcium',
            'total_calcium' => 'Total Calcium',
            'zinc_serum' => 'Zinc Serum',
            'mercury' => 'Mercury',
            'caesium' => 'Caesium',
            'beryllium' => 'Beryllium',
            'arsenic' => 'Arsenic',
            'phosphorus' => 'Phosphorus',
            'sodium' => 'Sodium',
            'pottasium' => 'Pottasium',
            'chloride' => 'Chloride',
            'magnesium' => 'Magnesium',
            'bilirubin_total' => 'Bilirubin Total',
            'bilirubin_direct' => 'Bilirubin Direct',
            'bilirubin_indirect' => 'Bilirubin Indirect',
            'sgot' => 'Sgot',
            'sgpt' => 'Sgpt',
            'alkaline_phosphatase' => 'Alkaline Phosphatase',
            'ggtp' => 'Ggtp',
            'iron_serum' => 'Iron Serum',
            'serum_total_proteins' => 'Serum Total Proteins',
            'serum_albumin' => 'Serum Albumin',
            'serum_globulin' => 'Serum Globulin',
            'globulin' => 'Globulin',
            'pancreatic_alfa_amylase' => 'Pancreatic Alfa Amylase',
            'cpk' => 'Cpk',
            'immunogloublin_igg' => 'Immunogloublin Igg',
            'immunogloublin_igm' => 'Immunogloublin Igm',
            'immunogloublin_ige' => 'Immunogloublin Ige',
            'immunogloublin_iga' => 'Immunogloublin Iga',
            'iron' => 'Iron',
            'total_iron_binding' => 'Total Iron Binding',
            'transfeerrin' => 'Transfeerrin',
            'transferrin_saturation' => 'Transferrin Saturation',
            'unsaturated_iron_binding' => 'Unsaturated Iron Binding',
            'ferritin' => 'Ferritin',
            'free_trijodothyronine' => 'Free Trijodothyronine',
            'free_thyroxine' => 'Free Thyroxine',
            'status' => 'Status',
            'report_url' => 'Report Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'del_status' => 'Del Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab()
    {
        return $this->hasOne(Lab::className(), ['id' => 'lab_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMubUser()
    {
        return $this->hasOne(MubUser::className(), ['id' => 'mub_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['id' => 'patient_id']);
    }
}
