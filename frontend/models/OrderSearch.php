<?php

namespace frontend\models;

class OrderSearch extends \frontend\models\Order { 

    public $party_name;
    public $item_name;  


    /**
     * {@inheritdoc}
     */
    public function rules()
    {   
        // var_dump(isset(\Yii::$app->request->get('OrderSearch')['party_name']) ? '0': 'party_id','integer'); die;
        return [
            [['oid','party_id', 'amount', 'status', 'payment_mode'], 'integer'],
            // [isset(\Yii::$app->request->get('OrderSearch')['party_name']) ? 'id': 'party_id','integer'],
            [['party_name','item_name', 'created_at'], 'safe']
        ];
    }
        
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params){

        $query = \frontend\models\Order::find();

        $query->joinWith(['party','items']);        

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $dataProvider->sort->attributes['party_name'] = [
            'asc' => ['party.name' => SORT_ASC],
            'desc' => ['party.name' => SORT_DESC]
        ];

        $dataProvider->sort->attributes['item_name'] = [
            'asc' => ['items.name' => SORT_ASC],
            'desc' => ['items.name' => SORT_DESC]
        ];

        
        // commented because sorting of other fields depends on andfilterwhere below.
        // if (!$params) {
        //     return $dataProvider;
        // }
        // var_dump($params); die;
        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }
            // var_dump($this->party_id); die;
            $query->andFilterWhere([
                '`order`.`oid`' => $this->oid,
                '`order`.`party_id`' => $this->party_id,
                '`order`.`amount`' => $this->amount,
                '`order`.`status`' => $this->status,
                'payment_mode' => $this->payment_mode,
                '`order`.`created_at`' => $this->created_at ? date("Y-m-d",strtotime($this->created_at)): NULL
            ]);

            $query->andFilterWhere(['like', 'party.name', $this->party_name]);
                // ->andFilterWhere(['like', 'items.name', $this->item_name]);

        return $dataProvider;
    }
}