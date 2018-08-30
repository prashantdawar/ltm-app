<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Items;

/**
 * ItemsSearch represents the model behind the search form of `app\models\Items`.
 */
class ItemsSearch extends Items
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'amount', 'mrp', 'in_stock', 'status', 'created_by', 'updated_by'], 'integer'],
            [['name', 'updated_at'], 'safe'],            
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
        $query = Items::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // if(!$params){
        //     return $dataProvider;
        // } // see ordersearch for reason of commenting.
        
        $this->load($params);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            // die;            
            return $dataProvider;
        }
        // var_dump($this->updated_at); die;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'amount' => $this->amount,
            'mrp' => $this->mrp,
            'updated_at' =>  $this->updated_at ? date("Y-m-d",strtotime($this->updated_at)): NULL
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
