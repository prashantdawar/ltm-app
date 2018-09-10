<?php

namespace frontend\models;

class PaymentsSearch extends \frontend\models\Payments
{
    public $party_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'party_id', 'payment_mode', 'amount', 'created_by', 'updated_by'], 'integer'],
            [['party_name','created_at', 'updated_at'], 'safe'],
        ];
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
        $query = \frontend\models\Payments::find();

        $query->joinWith(['party']);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $dataProvider->sort->attributes['party_name'] = [
            'asc' => ['party.name' => SORT_ASC],
            'desc' => ['party.name' => SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            // 'id' => $this->id,
            '`payments`.`party_id`' => $this->party_id,
            '`payments`.`payment_mode`' => $this->payment_mode,
            '`payments`.`amount`' => $this->amount,
            '`payments`.`created_at`' => $this->created_at ? date("Y-m-d",strtotime($this->created_at)): NULL
            // 'updated_at' => $this->updated_at,
            // 'created_by' => $this->created_by,
            // 'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'party.name', $this->party_name]);

        return $dataProvider;
    }
}