<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "party".
 *
 * @property int $id
 * @property int $uuid
 * @property string $name
 * @property int $total_orders // as modal property only
 * @property string $contact_name
 * @property int $phone
 * @property int $whatsapp
 * @property string $email
 * @property string $street_address
 * @property string $city
 * @property string $location
 * @property string $state
 * @property int $pincode
 * @property int $due
 * @property string $gst
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Party extends \yii\db\ActiveRecord
{

    public $total_orders;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'party';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'contact_name', 'phone','whatsapp', 'email', 'street_address', 'city', 'location', 'state', 'pincode', 'gst', 'uuid', 'created_at', 'updated_at'], 'required'],
            [['uuid', 'whatsapp','phone', 'pincode', 'due', 'status','total_orders'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['phone','whatsapp'], 'string', 'max' => 10 ],
            [['name', 'contact_name', 'email', 'street_address', 'city', 'location', 'state', 'gst'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'UUID',
            'name' => 'Party Name',
            'total_orders' => 'Total Orders',
            'contact_name' => 'Contact Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'street_address' => 'Street Address',
            'city' => 'City and Village',
            'location' => 'District',
            'state' => 'State',
            'pincode' => 'Pincode',
            'due' => 'Net Due Balance',
            'gst' => 'GSTIN Number',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function find(){
        return parent::find()->andWhere(['`'.strtolower((new \ReflectionClass(self::class))->getShortName()).'`.`created_by`' => \Yii::$app->user->id]);
    }

    // https://stackoverflow.com/q/42021165 // the GridView Filter calls beforeValidate() and the uses these values for a filter...
    // https://stackoverflow.com/a/42021681 // in gridview $this->validate() is called, so updated_at and updated_by fields are auto updated for each row.
    // public function beforeValidate(){
    //     if(!parent::beforeValidate()){
    //         return false;
    //     }
        
    //     if($this->isNewRecord){
    //         $this->created_at = date('Y-m-d');
    //         $this->created_by = \Yii::$app->user->id;
    //     }

    //     $this->updated_at = date('Y-m-d'); 
    //     $this->updated_by = \Yii::$app->user->id;
        
    //     return true;
    // }

    public function beforeSave($insert){        
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if($insert){
            $this->created_at = date('Y-m-d');    
        }
        
        $this->name = ucwords(strtolower($this->name));
        $this->contact_name = ucwords($this->contact_name);
        $this->city = ucwords($this->city);
        $this->location = ucwords($this->location);
        $this->state = ucwords($this->state);
        $this->phone = (float)$this->phone;
        $this->whatsapp = (float)$this->whatsapp;
        $this->created_at = date('Y-m-d', strtotime($this->created_at));
        $this->updated_at = date('Y-m-d');

        return true;
    }

    public function afterFind(){
        
        $this->created_at = date('d-m-Y', strtotime($this->created_at));
        $this->updated_at = date('d-m-Y', strtotime($this->updated_at));
        
        $this->total_orders = Order::find()->andWhere(['party_id' => $this->id])->count();

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    protected function getDueBalance(){
        // var_dump($this->id);
        // var_dump($this->hasMany(Order::className(), ['party_id' => 'id'])->asArray()->all());
        $party_payments = Payments::find()->select('amount,payment_mode')->andWhere(['party_id' => $this->id])->asArray()->all();

        $credit =0; $debit = 0;
        foreach($party_payments as $payments){
            ($payments['payment_mode'] == 1) ? $credit += $payments['amount'] : $debit += $payments['amount'];
        } 

        return $debit - $credit;
        // return $this->hasMany(Payments::className(), ['party_id' => 'id'])->select('amount, payment_mode, party_id')->asArray();        
    }
}
