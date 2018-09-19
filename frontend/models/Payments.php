<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $id
 * @property int $party_id
 * @property int $payment_mode
 * @property int $amount
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Payments extends \yii\db\ActiveRecord
{
    public $paymentMode =  ['0'=> 'Cash','1' => 'Credit', '2' => 'UPI', '3' => 'Paytm', '4' => 'Cheque', '5' => 'Online Transfer', '6' => 'Bank Transfer'];
    public $currencySymbol = '&#x20B9;';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['party_id', 'payment_mode', 'amount', 'created_at', 'updated_at'], 'required'],
            [['party_id', 'payment_mode', 'amount', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'notes'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'party_id' => 'Party Name',
            'payment_mode' => 'Payment Mode',
            'amount' => 'Amount',
            'notes' => 'Notes',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public static function find(){
        return parent::find()->andWhere(['`'.strtolower((new \ReflectionClass(self::class))->getShortName()).'`.`created_by`' => \Yii::$app->user->id]);
    }
    
    public function beforeSave($insert){        
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->created_at = date('Y-m-d', strtotime($this->created_at));
        $this->updated_at = date('Y-m-d', strtotime($this->updated_at));
        return true;
    }

    public function afterSave($insert, $changedAttributes){

        $modelParty = \frontend\models\Party::find()->where(['id' => $this->party_id])->one();
        $modelPayments = \frontend\models\Payments::find()->select('amount, payment_mode')->where(['party_id' => $this->party_id])->asArray()->all();;
        
        $credit =0; $debit = 0;
        foreach($modelPayments as $payments){
            ($payments['payment_mode'] == 1) ? $credit += $payments['amount'] : $debit += $payments['amount'];
        }
        
        $modelParty->due = $debit - $credit;        
        $modelParty->save();
    }

    public function afterFind(){        
        $this->created_at = date('d-m-Y', strtotime($this->created_at));
        $this->updated_at = date('d-m-Y', strtotime($this->updated_at));
        return true;
    }
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getParty(){
        return $this->hasOne(Party::className(), ['id' => 'party_id']);
    }
}