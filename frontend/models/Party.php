<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "party".
 *
 * @property int $id
 * @property string $name
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
 */
class Party extends \yii\db\ActiveRecord
{
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
            [['name', 'contact_name', 'phone','whatsapp', 'email', 'street_address', 'city', 'location', 'state', 'pincode', 'gst', 'created_at', 'updated_at'], 'required'],
            [['whatsapp','phone', 'pincode', 'due', 'status',], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['phone','whatsapp'], 'string', 'min' => 10, 'max' => 10 ],
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
            'name' => 'Party Name',
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

    public function beforeSave($insert){
        
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->phone = (int)$this->phone;
        $this->whatsapp = (int)$this->whatsapp;
        $this->created_at = date('Y-m-d', strtotime($this->created_at));
        $this->updated_at = date('Y-m-d', strtotime($this->updated_at));

        return true;
    }

    public function afterFind(){
        
        $this->created_at = date('d-m-Y', strtotime($this->created_at));
        $this->updated_at = date('d-m-Y', strtotime($this->updated_at));

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    protected function getDueBalance(){
        // var_dump($this->id);
        // var_dump($this->hasMany(Order::className(), ['party_id' => 'id'])->asArray()->all());
        $party_payments = Payments::find()->select('amount,payment_mode')->where(['party_id' => $this->id])->asArray()->all();

        $credit =0; $debit = 0;
        foreach($party_payments as $payments){
            ($payments['payment_mode'] == 1) ? $credit += $payments['amount'] : $debit += $payments['amount'];
        } 

        return $debit - $credit;
        // return $this->hasMany(Payments::className(), ['party_id' => 'id'])->select('amount, payment_mode, party_id')->asArray();        
    }
}