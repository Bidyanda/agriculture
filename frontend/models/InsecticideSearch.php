<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Insecticide;

/**
 * InsecticideSearch represents the model behind the search form of `frontend\models\Insecticide`.
 */
class InsecticideSearch extends Insecticide
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pp_id', 'sl_no'], 'integer'],
            [['particular_of_insecticide', 'name_of_manufacturer', 'registration_no', 'principal_certificate_no', 'principal_certificate_date_of_issue', 'principal_certificate_validity'], 'safe'],
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
        $query = Insecticide::find();

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
            'pp_id' => $this->pp_id,
            'sl_no' => $this->sl_no,
            'principal_certificate_date_of_issue' => $this->principal_certificate_date_of_issue,
            'principal_certificate_validity' => $this->principal_certificate_validity,
        ]);

        $query->andFilterWhere(['like', 'particular_of_insecticide', $this->particular_of_insecticide])
            ->andFilterWhere(['like', 'name_of_manufacturer', $this->name_of_manufacturer])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'principal_certificate_no', $this->principal_certificate_no]);

        return $dataProvider;
    }
}
