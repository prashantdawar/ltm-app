<?php

namespace frontend\models;

class PartySearch extends Party{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'pincode', 'last_order_id', 'status', 'created_at', 'updated_at'], 'integer'],
            // ['phone', 'string', 'min' => 10, 'max' => 10 ],
            [['name', 'contact_name', 'email', 'street_address', 'city', 'location', 'state', 'gst'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
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
        
        $query = Party::find();

        // $query->joinWith(['payments']);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'phone' => $this->phone,
            'pincode' => $this->pincode,
            'last_order_is' => $this->last_order_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
        
        $query->andFilterWhere(['like','name', $this->name])
            ->andFilterWhere(['like','contact_name',$this->contact_name])
            ->andFilterWhere(['like','phone',$this->phone])
            ->andFilterWhere(['like','email',$this->email])
            ->andFilterWhere(['like','street_address', $this->street_address])
            ->andFilterWhere(['like','city', $this->city])
            ->andFilterWhere(['like','location', $this->location])
            ->andFilterWhere(['like','state', $this->state])
            ->andFilterWhere(['like','gst', $this->gst]);

        return $dataProvider;
    }
}