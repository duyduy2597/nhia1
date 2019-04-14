<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form of `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pro_id', 'pro_price', 'cat_id', 'supplier', 'pro_size_id', 'pro_color_id', 'pro_made_id', 'created_at', 'updated_at'], 'integer'],
            [['pro_name', 'pro_image', 'pro_sale_off', 'description', 'date_sale_off', 'end_cate_sale', 'meta_keyword', 'meta_description', 'comment', 'complaint'], 'safe'],
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
        $query = Product::find();

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
            'pro_id' => $this->pro_id,
            'pro_price' => $this->pro_price,
            'cat_id' => $this->cat_id,
            'supplier' => $this->supplier,
            'pro_size_id' => $this->pro_size_id,
            'pro_color_id' => $this->pro_color_id,
            'pro_made_id' => $this->pro_made_id,
            'date_sale_off' => $this->date_sale_off,
            'end_cate_sale' => $this->end_cate_sale,
            'isDeleted' => 0,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'pro_name', $this->pro_name])
            ->andFilterWhere(['like', 'pro_image', $this->pro_image])
            ->andFilterWhere(['like', 'pro_sale_off', $this->pro_sale_off])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'meta_keyword', $this->meta_keyword])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'complaint', $this->complaint]);

        return $dataProvider;
    }
}
