<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PatientReport;

/**
 * PatientReportsSearch represents the model behind the search form of `app\models\PatientReport`.
 */
class PatientReportsSearch extends PatientReport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'patient_id', 'lab_id', 'mub_user_id'], 'integer'],
            [['haemoglobin', 'total_leucocyte_count', 'red_blood_cell', 'packed_cell_volume', 'mean_corpuscular_volume', 'esr', 'mean_corpusular_hb', 'mean_corpusular_hb_conc', 'mean_platelets_volume', 'hemoglobin_distribution_width', 'corpuscular_hemoglobin', 'chcm', 'platelet_distribution_width', 'pct', 'platelet_count', 'neutrophils', 'lymphocytes', 'monocytes', 'eosinophils', 'basophils', 'large_unstained_cells', 'red_cell_distribution_width', 'rdw_sd', 'absolute_eosinophils_count', 'large_unstained_cell', 'cholesterol', 'triglycetides', 'hdl_cholesterol', 'ldl_cholesterol', 'serum_vldl_cholesterol', 'non_hdl_cholesterol', 'sedum_cholesterol_hdl_ratio', 'ldl_hdl_cholesterol_ratio', 'urea', 'blood_urea_nitrogen', 'creatinine_serum', 'uric_acid', 'urea_creatinine_ratio', 'bun_creatinine_ratio', 'cystatin_c', 'blood_ketone', 'ionized_calcium', 'total_calcium', 'zinc_serum', 'mercury', 'caesium', 'beryllium', 'arsenic', 'phosphorus', 'sodium', 'pottasium', 'chloride', 'magnesium', 'bilirubin_total', 'bilirubin_direct', 'bilirubin_indirect', 'sgot', 'sgpt', 'alkaline_phosphatase', 'ggtp', 'iron_serum', 'serum_total_proteins', 'serum_albumin', 'serum_globulin', 'globulin', 'pancreatic_alfa_amylase', 'cpk', 'immunogloublin_igg', 'immunogloublin_igm', 'immunogloublin_ige', 'immunogloublin_iga', 'iron', 'total_iron_binding', 'transfeerrin', 'transferrin_saturation', 'unsaturated_iron_binding', 'ferritin', 'free_trijodothyronine', 'free_thyroxine', 'status', 'report_url', 'created_at', 'updated_at', 'del_status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PatientReport::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'lab_id' => $this->lab_id,
            'mub_user_id' => $this->mub_user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'haemoglobin', $this->haemoglobin])
            ->andFilterWhere(['like', 'total_leucocyte_count', $this->total_leucocyte_count])
            ->andFilterWhere(['like', 'red_blood_cell', $this->red_blood_cell])
            ->andFilterWhere(['like', 'packed_cell_volume', $this->packed_cell_volume])
            ->andFilterWhere(['like', 'mean_corpuscular_volume', $this->mean_corpuscular_volume])
            ->andFilterWhere(['like', 'esr', $this->esr])
            ->andFilterWhere(['like', 'mean_corpusular_hb', $this->mean_corpusular_hb])
            ->andFilterWhere(['like', 'mean_corpusular_hb_conc', $this->mean_corpusular_hb_conc])
            ->andFilterWhere(['like', 'mean_platelets_volume', $this->mean_platelets_volume])
            ->andFilterWhere(['like', 'hemoglobin_distribution_width', $this->hemoglobin_distribution_width])
            ->andFilterWhere(['like', 'corpuscular_hemoglobin', $this->corpuscular_hemoglobin])
            ->andFilterWhere(['like', 'chcm', $this->chcm])
            ->andFilterWhere(['like', 'platelet_distribution_width', $this->platelet_distribution_width])
            ->andFilterWhere(['like', 'pct', $this->pct])
            ->andFilterWhere(['like', 'platelet_count', $this->platelet_count])
            ->andFilterWhere(['like', 'neutrophils', $this->neutrophils])
            ->andFilterWhere(['like', 'lymphocytes', $this->lymphocytes])
            ->andFilterWhere(['like', 'monocytes', $this->monocytes])
            ->andFilterWhere(['like', 'eosinophils', $this->eosinophils])
            ->andFilterWhere(['like', 'basophils', $this->basophils])
            ->andFilterWhere(['like', 'large_unstained_cells', $this->large_unstained_cells])
            ->andFilterWhere(['like', 'red_cell_distribution_width', $this->red_cell_distribution_width])
            ->andFilterWhere(['like', 'rdw_sd', $this->rdw_sd])
            ->andFilterWhere(['like', 'absolute_eosinophils_count', $this->absolute_eosinophils_count])
            ->andFilterWhere(['like', 'large_unstained_cell', $this->large_unstained_cell])
            ->andFilterWhere(['like', 'cholesterol', $this->cholesterol])
            ->andFilterWhere(['like', 'triglycetides', $this->triglycetides])
            ->andFilterWhere(['like', 'hdl_cholesterol', $this->hdl_cholesterol])
            ->andFilterWhere(['like', 'ldl_cholesterol', $this->ldl_cholesterol])
            ->andFilterWhere(['like', 'serum_vldl_cholesterol', $this->serum_vldl_cholesterol])
            ->andFilterWhere(['like', 'non_hdl_cholesterol', $this->non_hdl_cholesterol])
            ->andFilterWhere(['like', 'sedum_cholesterol_hdl_ratio', $this->sedum_cholesterol_hdl_ratio])
            ->andFilterWhere(['like', 'ldl_hdl_cholesterol_ratio', $this->ldl_hdl_cholesterol_ratio])
            ->andFilterWhere(['like', 'urea', $this->urea])
            ->andFilterWhere(['like', 'blood_urea_nitrogen', $this->blood_urea_nitrogen])
            ->andFilterWhere(['like', 'creatinine_serum', $this->creatinine_serum])
            ->andFilterWhere(['like', 'uric_acid', $this->uric_acid])
            ->andFilterWhere(['like', 'urea_creatinine_ratio', $this->urea_creatinine_ratio])
            ->andFilterWhere(['like', 'bun_creatinine_ratio', $this->bun_creatinine_ratio])
            ->andFilterWhere(['like', 'cystatin_c', $this->cystatin_c])
            ->andFilterWhere(['like', 'blood_ketone', $this->blood_ketone])
            ->andFilterWhere(['like', 'ionized_calcium', $this->ionized_calcium])
            ->andFilterWhere(['like', 'total_calcium', $this->total_calcium])
            ->andFilterWhere(['like', 'zinc_serum', $this->zinc_serum])
            ->andFilterWhere(['like', 'mercury', $this->mercury])
            ->andFilterWhere(['like', 'caesium', $this->caesium])
            ->andFilterWhere(['like', 'beryllium', $this->beryllium])
            ->andFilterWhere(['like', 'arsenic', $this->arsenic])
            ->andFilterWhere(['like', 'phosphorus', $this->phosphorus])
            ->andFilterWhere(['like', 'sodium', $this->sodium])
            ->andFilterWhere(['like', 'pottasium', $this->pottasium])
            ->andFilterWhere(['like', 'chloride', $this->chloride])
            ->andFilterWhere(['like', 'magnesium', $this->magnesium])
            ->andFilterWhere(['like', 'bilirubin_total', $this->bilirubin_total])
            ->andFilterWhere(['like', 'bilirubin_direct', $this->bilirubin_direct])
            ->andFilterWhere(['like', 'bilirubin_indirect', $this->bilirubin_indirect])
            ->andFilterWhere(['like', 'sgot', $this->sgot])
            ->andFilterWhere(['like', 'sgpt', $this->sgpt])
            ->andFilterWhere(['like', 'alkaline_phosphatase', $this->alkaline_phosphatase])
            ->andFilterWhere(['like', 'ggtp', $this->ggtp])
            ->andFilterWhere(['like', 'iron_serum', $this->iron_serum])
            ->andFilterWhere(['like', 'serum_total_proteins', $this->serum_total_proteins])
            ->andFilterWhere(['like', 'serum_albumin', $this->serum_albumin])
            ->andFilterWhere(['like', 'serum_globulin', $this->serum_globulin])
            ->andFilterWhere(['like', 'globulin', $this->globulin])
            ->andFilterWhere(['like', 'pancreatic_alfa_amylase', $this->pancreatic_alfa_amylase])
            ->andFilterWhere(['like', 'cpk', $this->cpk])
            ->andFilterWhere(['like', 'immunogloublin_igg', $this->immunogloublin_igg])
            ->andFilterWhere(['like', 'immunogloublin_igm', $this->immunogloublin_igm])
            ->andFilterWhere(['like', 'immunogloublin_ige', $this->immunogloublin_ige])
            ->andFilterWhere(['like', 'immunogloublin_iga', $this->immunogloublin_iga])
            ->andFilterWhere(['like', 'iron', $this->iron])
            ->andFilterWhere(['like', 'total_iron_binding', $this->total_iron_binding])
            ->andFilterWhere(['like', 'transfeerrin', $this->transfeerrin])
            ->andFilterWhere(['like', 'transferrin_saturation', $this->transferrin_saturation])
            ->andFilterWhere(['like', 'unsaturated_iron_binding', $this->unsaturated_iron_binding])
            ->andFilterWhere(['like', 'ferritin', $this->ferritin])
            ->andFilterWhere(['like', 'free_trijodothyronine', $this->free_trijodothyronine])
            ->andFilterWhere(['like', 'free_thyroxine', $this->free_thyroxine])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'report_url', $this->report_url])
            ->andFilterWhere(['like', 'del_status', $this->del_status]);

        return $dataProvider;
    }
}
