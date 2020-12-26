<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\FertilizerItem;

/**
 * FertilizerItemSearch represents the model behind the search form of `frontend\models\FertilizerItem`.
 */
class FertilizerItemSearch extends FertilizerItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'f_id'], 'integer'],
            [['fertilizer_name', 'whether_cert_form_o_attach'], 'safe'],
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
        $query = FertilizerItem::find();

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
            'f_id' => $this->f_id,
        ]);

        $query->andFilterWhere(['like', 'fertilizer_name', $this->fertilizer_name])
            ->andFilterWhere(['like', 'whether_cert_form_o_attach', $this->whether_cert_form_o_attach]);

        return $dataProvider;
    }
}
