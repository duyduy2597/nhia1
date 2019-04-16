<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Order;

/**
 * OrderSearch represents the model behind the search form of `backend\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'updated_at',  'created_at'], 'integer'],
            [['use_id', 'use_name', 'email', 'mobile', 'address', 'user_ship', 'mobile_ship', 'address_ship', 'request'], 'safe'],
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
        $query = Order::find();

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
            'order_id' => $this->order_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'use_id', $this->use_id])
            ->andFilterWhere(['like', 'use_name', $this->use_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'user_ship', $this->user_ship])
            ->andFilterWhere(['like', 'mobile_ship', $this->mobile_ship])
            ->andFilterWhere(['like', 'address_ship', $this->address_ship])
            ->andFilterWhere(['like', 'request', $this->request]);

        return $dataProvider;
    }
}
