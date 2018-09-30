<?php

namespace frontend\models;

class PartySearch extends Party{

    public $due_condition;
    public $due_condition_options = ['>' => 'Debit', '<' => 'Credit', '=' => 'Balanced'];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'pincode', 'due', 'status', 'created_at', 'updated_at'], 'integer'],
            // ['phone', 'string', 'min' => 10, 'max' => 10 ],
            [['name', 'due_condition','contact_name', 'email', 'street_address', 'city', 'location', 'state', 'gst'], 'string', 'max' => 255],
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

        $operator = 'like';
        $comparator = $this->due;
        // because https://stackoverflow.com/a/7091714/3690154
        // var_dump($this->due_condition); die;
        if(isset($this->due_condition) && strlen($this->due_condition) > 0){
            
            $queryString = $this->due_condition;
            switch($queryString){
                case strpos($queryString,'>') === 0:
                    $operator = '>'; $comparator = 0;break;
                case strpos($queryString,'<') === 0:
                    $operator = '<'; $comparator = 0;break;
                case strpos($queryString,'=') === 0:
                    $operator = '='; $comparator = 0;break;
                default:
                    $operator = 'like'; $comparator = $this->due; break;
            }
        }
        // var_dump($comparator); die;
        $query->andFilterWhere([$operator, 'due', $comparator]);
        return $dataProvider;
    }
}