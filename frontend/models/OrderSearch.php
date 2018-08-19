<?php

namespace frontend\models;

class OrderSearch extends \frontend\models\Order {

    public function search($params){

        $query = \frontend\models\Order::find();

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        return $dataProvider;
    }
}