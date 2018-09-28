<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $oid
 * @property int $party_id 
 * @property string $item_id
 * @property int $amount
 * @property int $status
 * @property string $notes
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Order extends \yii\db\ActiveRecord
{   
    
    public $paymentMode =  ['0'=> 'Cash','1' => 'Credit', '2' => 'UPI', '3' => 'Paytm', '4' => 'Cheque', '5' => 'Online Transfer', '6' => 'Bank Transfer'];
    public $orderStatus =  ['0' => 'Completed', '1' => 'Pending', '2' => 'Processing', '3' => 'Cancelled', '4' => 'Halt'];
    public $currencySymbol = '&#x20B9;';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'party_id','amount', 'status', 'payment_mode'], 'required'],
            ['item_id', 'required','message' => 'Item Name cannot be blank'],
            [['oid','amount', 'status',  'created_by', 'updated_by'], 'integer'],
            [['item_id', 'payment_id', 'created_at', 'updated_at', 'notes'], 'safe']
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'party_id' => 'Party ID', 
            'item_id' => 'Item ID',
            'amount' => 'Net Amount Payable',
            'payment_id' => 'Payment Id',
            'status' => 'Status',
            'notes' => 'Notes',
            'payment_mode' => 'Payment Mode',
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
        
        // $insert is true when model entry is new!
       if($insert){
            // var_dump(\frontend\models\PrimaryIds::find()->select('order_id')->asArray()->one()); die;
            $primary_ids = \frontend\models\PrimaryIds::find()->select('order_id')->asArray()->one();
            $this->oid =  $primary_ids['order_id'] + 1;
        }
        // var_dump($this->payment_id); die;
        $this->payment_id = implode(',', $this->payment_id);
        $this->item_id = implode(',', $this->item_id);
        $this->created_at = date('Y-m-d', strtotime($this->created_at));
        $this->updated_at = date('Y-m-d', strtotime($this->updated_at));
        
        return true;
    }

    public function afterSave($insert, $changedAttributes){
        // $insert is true when model entry is new!
        // $changedAttributes are empty when model entry is new!
        /*
        var_dump($insert);
        var_dump($changedAttributes); die;
        bool(true) array(12) { ["created_at"]=> NULL ["updated_at"]=> NULL ["created_by"]=> NULL ["updated_by"]=> NULL ["item_id"]=> NULL ["party_id"]=> NULL ["amount"]=> NULL ["payment_mode"]=> NULL ["status"]=> NULL ["notes"]=> NULL ["oid"]=> NULL ["id"]=> NULL }
        */        

        $this->item_id = explode(',', $this->item_id);
        $this->payment_id = explode(',', $this->payment_id);
        
        if(!$insert){
            if(((int)$this->payment_id[0] != 0)){            
                $modelPaymentsCredit = \frontend\models\Payments::find()->where(['id' => $this->payment_id[0]])->one();
                // var_dump($this->party_id);die;
                $modelPaymentsCredit->party_id = $this->party_id;
                $modelPaymentsCredit->save();
                if(count($this->payment_id) == 2 ){
                    $modelPaymentsDebit = \frontend\models\Payments::find()->where(['id' => $this->payment_id[1]])->one();
                    $modelPaymentsDebit->party_id = $this->party_id;
                    $modelPaymentsDebit->save();
                }
            }
        }

        $primary_ids = \frontend\models\PrimaryIds::find()->one();
        $primary_ids->order_id = $primary_ids->order_id +1;
        $primary_ids->save();
    }

    public function afterFind(){
        
        $this->item_id = explode(',', $this->item_id);
        $this->payment_id = explode(',', $this->payment_id);
        $this->created_at = date('d-m-Y', strtotime($this->created_at));
        $this->updated_at = date('d-m-Y', strtotime($this->updated_at));

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    protected function getParty(){
        return $this->hasOne(Party::className(), ['id' => 'party_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    protected function getItems(){        
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }
    
    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail($model, $firmModel, $partyModel, $dataItem, $dataAmount)
    {
        $userModel = \frontend\models\PrimaryIds::find()->select('email')->where(['created_by' => \Yii::$app->user->id])->asArray()->one();
        // var_dump($userModel['email']); die;
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => '/order/orderpdf'],
                [
                    'model' => $model,
                    'firmModel' => $firmModel,
                    'partyModel' => $partyModel,
                    'dataItem' => $dataItem,
                    'dataAmount' => $dataAmount                            
                ])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($partyModel->email)
            ->setBcc(['sales@datapacks.in', $userModel['email']])
            ->setSubject('Order Details for: ' . $this->oid . ' from ltm web app')
            ->send();
    }
}