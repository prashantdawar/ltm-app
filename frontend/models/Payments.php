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
 * @property string $notes
 * @property string $activity_log
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
            [['pid', 'party_id', 'payment_mode', 'amount', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'notes', 'activity_log'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Voucher No.',
            'party_id' => 'Party Name',
            'payment_mode' => 'Payment Mode',
            'amount' => 'Amount',
            'notes' => 'Notes',
            'activity_log' => 'Activity Log',
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
        if($insert){
            $this->created_by = \Yii::$app->user->id;
            $modelPrimaryIds = PrimaryIds::find()->andWhere(['created_by' => \Yii::$app->user->id])->one();
            $this->pid = $modelPrimaryIds->payments_id;
        }
        

        // var_dump($this->attributes);
        // var_dump($this->oldAttributes);
        if(!empty($this->oldAttributes)){
            if($this->oldAttributes['party_id'] != $this->party_id){
                $modelOldParty = Party::find()->select('name')->andWhere(['id' => $this->oldAttributes['party_id']])->one();
                $modelNewParty = Party::find()->select('name')->andWhere(['id' => $this->party_id])->one();
                $log = 'Party Name Changed from '. $modelOldParty['name']. ' to '. $modelNewParty['name'];
                $this->activity_log = $log.'.<br>'.$this->activity_log;
            }
            if($this->oldAttributes['amount'] != $this->amount){
                $log = 'Changed Amount from '.$this->currencySymbol.' '.$this->oldAttributes['amount'].' to '.$this->currencySymbol.' '.$this->amount;
                $this->activity_log = $log.'.<br>'.$this->activity_log;
            }
            
        } else {
            $this->activity_log = 'Amount of '.$this->currencySymbol.' '.$this->amount.' added.';
        }

        $this->updated_by = \Yii::$app->user->id;
        $this->created_at = date('Y-m-d', strtotime($this->created_at));
        $this->updated_at = date('Y-m-d', strtotime($this->updated_at));
        return true;
    }

    public function afterSave($insert, $changedAttributes){

        // var_dump($changedAttributes); die;
        $modelParty = \frontend\models\Party::find()->andWhere(['id' => $this->party_id])->one();
        $modelPayments = \frontend\models\Payments::find()->select('amount, payment_mode')->andWhere(['party_id' => $this->party_id])->asArray()->all();;
        
        $credit =0; $debit = 0;
        foreach($modelPayments as $payments){
            // var_dump($payments); 
            ($payments['payment_mode'] == 1) ? $credit += $payments['amount'] : $debit += $payments['amount'];
        }
        // die;
        $modelParty->due = $debit - $credit;
                
        $modelParty->save();
        unset($modelParty);
        unset($modelPayments);
        // reset due for changed party again.
        // check for null and empty string.
        if(!empty($changedAttributes['party_id']) && ($changedAttributes['party_id'] != $this->party_id)){
            $modelParty = Party::find()->andWhere(['id' => $changedAttributes['party_id']])->one();
            $modelPayments = Payments::find()->select('amount, payment_mode')->andWhere(['party_id' => $changedAttributes['party_id']])->asArray()->all();;
        
            $credit =0; $debit = 0;
            foreach($modelPayments as $payments){
                ($payments['payment_mode'] == 1) ? $credit += $payments['amount'] : $debit += $payments['amount'];
            }
            
            $modelParty->due = $debit - $credit;        
            $modelParty->save();
        }

        if($insert){
            $modelPrimaryIds = PrimaryIds::find()->andWhere(['created_by' => \Yii::$app->user->id])->one();
            $modelPrimaryIds->payments_id = $modelPrimaryIds->payments_id + 1;
            $modelPrimaryIds->save();
        }
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