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
        return [
            [['id', 'amount', 'status'], 'integer'],
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
            // var_dump($this->created_at); die;
            $query->andFilterWhere([
                '`order`.`id`' => $this->id,
                '`order`.`amount`' => $this->amount,
                '`order`.`status`' => $this->status,
                '`order`.`created_at`' => $this->created_at ? date("Y-m-d",strtotime($this->created_at)): NULL
            ]);

            $query->andFilterWhere(['like', 'party.name', $this->party_name])
                ->andFilterWhere(['like', 'items.name', $this->item_name]);

        return $dataProvider;
    }
}