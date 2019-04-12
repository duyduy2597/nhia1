<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\business\MySql\City as MySql_City;

/**
 * CitiesSearch represents the model behind the search form of `common\models\business\MySql\City`.
 */
class CitiesSearch extends MySql_City
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'isDeleted', 'deletedUserId', 'deletedTime'], 'integer'],
            [['cityname'], 'safe'],
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
        $query = MySql_City::find();

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
        
        $query->where(['isDeleted' => false]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'isDeleted' => $this->isDeleted,
            'deletedUserId' => $this->deletedUserId,
            'deletedTime' => $this->deletedTime,
        ]);

        $query->andFilterWhere(['like', 'cityname', $this->cityname]);

        return $dataProvider;
    }
}
