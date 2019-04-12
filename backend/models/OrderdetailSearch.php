<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orderdetail;

/**
 * OrderdetailSearch represents the model behind the search form of `backend\models\Orderdetail`.
 */
class OrderdetailSearch extends Orderdetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail_id', 'order_id', 'pro_id', 'pro_price', 'pro_amount', 'status', 'created_at', 'updated_at'], 'integer'],
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
        $query = Orderdetail::find();

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
            'detail_id' => $this->detail_id,
            'order_id' => $this->order_id,
            'pro_id' => $this->pro_id,
            'pro_price' => $this->pro_price,
            'pro_amount' => $this->pro_amount,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
