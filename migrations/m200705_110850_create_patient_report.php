<?php

namespace app\migrations;
use app\commands\Migration;

/**
 * Class m200705_110850_create_patient_report
 */
class m200705_110850_create_patient_report extends Migration
{
   public function getTableName()
    {
        return 'patient_report';
    }
    public function getForeignKeyFields()
    {
        return [
            'mub_user_id' => ['mub_user', 'id'],
            'patient_id' => ['patient','id'],
            'lab_id' => ['lab','id']
        ];
    }

    public function getKeyFields()
    {
        return [];
    }

    public function getFields()
    {
        return [
            'id' => $this->primaryKey(),
            'patient_id' => $this->integer()->notNull(),
            'lab_id' => $this->integer()->notNull(),
            'mub_user_id' => $this->integer()->notNull(),
            'haemoglobin' => $this->string(255)->defaultValue(NULL),
            'total_leucocyte_count' => $this->string(255)->defaultValue(NULL),
            'red_blood_cell' => $this->string(255)->defaultValue(NULL),
            'packed_cell_volume' => $this->string(255)->defaultValue(NULL),
            'mean_corpuscular_volume' => $this->string(255)->defaultValue(NULL),
            'esr' => $this->string(255)->defaultValue(NULL),
            'mean_corpusular_hb' => $this->string(255)->defaultValue(NULL),
            'mean_corpusular_hb_conc' => $this->string(255)->defaultValue(NULL),
            'mean_platelets_volume' => $this->string(255)->defaultValue(NULL),
            'hemoglobin_distribution_width' => $this->string(255)->defaultValue(NULL),
            'corpuscular_hemoglobin' => $this->string(255)->defaultValue(NULL),
            'chcm' => $this->string(255)->defaultValue(NULL),
            'platelet_distribution_width' => $this->string(255)->defaultValue(NULL),
            'pct' => $this->string(255)->defaultValue(NULL),
            'platelet_count' => $this->string(255)->defaultValue(NULL),
            'neutrophils' => $this->string(255)->defaultValue(NULL),
            'lymphocytes' => $this->string(255)->defaultValue(NULL),
            'monocytes' => $this->string(255)->defaultValue(NULL),
            'eosinophils' => $this->string(255)->defaultValue(NULL),
            'basophils' => $this->string(255)->defaultValue(NULL),
            'large_unstained_cells' => $this->string(255)->defaultValue(NULL),
            'red_cell_distribution_width' => $this->string(255)->defaultValue(NULL),
            'rdw_sd' => $this->string(255)->defaultValue(NULL),
            'neutrophils' => $this->string(255)->defaultValue(NULL),
            'lymphocytes' => $this->string(255)->defaultValue(NULL),
            'monocytes' => $this->string(255)->defaultValue(NULL),
            'absolute_eosinophils_count' => $this->string(255)->defaultValue(NULL),
            'basophils' => $this->string(255)->defaultValue(NULL),
            'large_unstained_cell' => $this->string(255)->defaultValue(NULL),
            'cholesterol' => $this->string(255)->defaultValue(NULL),
            'triglycetides' => $this->string(255)->defaultValue(NULL),
            'hdl_cholesterol' => $this->string(255)->defaultValue(NULL),
            'ldl_cholesterol' => $this->string(255)->defaultValue(NULL),
            'serum_vldl_cholesterol' => $this->string(255)->defaultValue(NULL),
            'non_hdl_cholesterol' => $this->string(255)->defaultValue(NULL),
            'sedum_cholesterol_hdl_ratio' => $this->string(255)->defaultValue(NULL),
            'ldl_hdl_cholesterol_ratio' => $this->string(255)->defaultValue(NULL),
            'urea' => $this->string(255)->defaultValue(NULL),
            'blood_urea_nitrogen' => $this->string(255)->defaultValue(NULL),
            'creatinine_serum' => $this->string(255)->defaultValue(NULL),
            'uric_acid' => $this->string(255)->defaultValue(NULL),
            'urea_creatinine_ratio' => $this->string(255)->defaultValue(NULL),
            'bun_creatinine_ratio' => $this->string(255)->defaultValue(NULL),
            'cystatin_c' => $this->string(255)->defaultValue(NULL),
            'blood_ketone' => $this->string(255)->defaultValue(NULL),
            'ionized_calcium' => $this->string(255)->defaultValue(NULL),
            'total_calcium' => $this->string(255)->defaultValue(NULL),
            'zinc_serum' => $this->string(255)->defaultValue(NULL),
            'mercury' => $this->string(255)->defaultValue(NULL),
            'caesium' => $this->string(255)->defaultValue(NULL),
            'beryllium' => $this->string(255)->defaultValue(NULL),
            'arsenic' => $this->string(255)->defaultValue(NULL),
            'phosphorus' => $this->string(255)->defaultValue(NULL),
            'sodium' => $this->string(255)->defaultValue(NULL),
            'pottasium' => $this->string(255)->defaultValue(NULL),
            'chloride' => $this->string(255)->defaultValue(NULL),
            'magnesium' => $this->string(255)->defaultValue(NULL),
            'bilirubin_total' => $this->string(255)->defaultValue(NULL),
            'bilirubin_direct' => $this->string(255)->defaultValue(NULL),
            'bilirubin_indirect' => $this->string(255)->defaultValue(NULL),
            'sgot' => $this->string(255)->defaultValue(NULL),
            'sgpt' => $this->string(255)->defaultValue(NULL),
            'alkaline_phosphatase' => $this->string(255)->defaultValue(NULL),
            'ggtp' => $this->string(255)->defaultValue(NULL),
            'iron_serum' => $this->string(255)->defaultValue(NULL),
            'serum_total_proteins' => $this->string(255)->defaultValue(NULL),
            'serum_albumin' => $this->string(255)->defaultValue(NULL),
            'serum_globulin' => $this->string(255)->defaultValue(NULL),
            'globulin' => $this->string(255)->defaultValue(NULL),
            'pancreatic_alfa_amylase' => $this->string(255)->defaultValue(NULL),
            'cpk' => $this->string(255)->defaultValue(NULL),
            'immunogloublin_igg' => $this->string(255)->defaultValue(NULL),
            'immunogloublin_igm' => $this->string(255)->defaultValue(NULL),
            'immunogloublin_ige' => $this->string(255)->defaultValue(NULL),
            'immunogloublin_iga' => $this->string(255)->defaultValue(NULL),
            'iron' => $this->string(255)->defaultValue(NULL),
            'total_iron_binding' => $this->string(255)->defaultValue(NULL),
            'transfeerrin' => $this->string(255)->defaultValue(NULL),
            'transferrin_saturation' => $this->string(255)->defaultValue(NULL),
            'unsaturated_iron_binding' => $this->string(255)->defaultValue(NULL),
            'ferritin' => $this->string(255)->defaultValue(NULL),
            'free_trijodothyronine' => $this->string(255)->defaultValue(NULL),
            'free_thyroxine' => $this->string(255)->defaultValue(NULL),
            'status' => "enum('Active','Inactive') NOT NULL DEFAULT 'Active'",
            'report_url' => "text DEFAULT NULL",
            'created_at' => $this->dateTime()->notNull()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->dateTime()->notNull()->defaultValue('1970-01-01 12:00:00'),
            'del_status' => "enum('0','1') NOT NULL COMMENT '0-Active,1-Deleted DEFAULT 0' DEFAULT '0'",
        ];
    }
}
