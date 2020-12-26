<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Fertilizer;

/**
 * FertilizerSearch represents the model behind the search form of `frontend\models\Fertilizer`.
 */
class FertilizerSearch extends Fertilizer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'address_of_sale', 'address_of_storage', 'created_by', 'record_status'], 'integer'],
            [['manufacture', 'importer', 'pool_handling_agency', 'wholesale_dealer', 'retail_dealer', 'application_date', 'status', 'created_date', 'district_officer_verified', 'directorate_officer_verified', 'payment_status', 'application_fee_date'], 'safe'],
            [['application_fee_amount'], 'number'],
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
        $query = Fertilizer::find();

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
            'user_id' => $this->user_id,
            'address_of_sale' => $this->address_of_sale,
            'address_of_storage' => $this->address_of_storage,
            'application_date' => $this->application_date,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'record_status' => $this->record_status,
            'application_fee_date' => $this->application_fee_date,
            'application_fee_amount' => $this->application_fee_amount,
        ]);

        $query->andFilterWhere(['like', 'manufacture', $this->manufacture])
            ->andFilterWhere(['like', 'importer', $this->importer])
            ->andFilterWhere(['like', 'pool_handling_agency', $this->pool_handling_agency])
            ->andFilterWhere(['like', 'wholesale_dealer', $this->wholesale_dealer])
            ->andFilterWhere(['like', 'retail_dealer', $this->retail_dealer])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'district_officer_verified', $this->district_officer_verified])
            ->andFilterWhere(['like', 'directorate_officer_verified', $this->directorate_officer_verified])
            ->andFilterWhere(['like', 'payment_status', $this->payment_status]);

        return $dataProvider;
    }
}
