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
            [['item_id','created_at', 'updated_at', 'notes'], 'safe']
            
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
        
        $this->item_id = implode(',', $this->item_id);
        $this->created_at = date('Y-m-d', strtotime($this->created_at));
        $this->updated_at = date('Y-m-d', strtotime($this->updated_at));

        return true;
    }

    public function afterFind(){
        
        $this->item_id = explode(',', $this->item_id);
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
    public function sendEmail($model, $partyModel, $dataItem, $dataAmount)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => '/order/orderpdf'],
                [
                    'model' => $model,
                    'partyModel' => $partyModel,
                    'dataItem' => $dataItem,
                    'dataAmount' => $dataAmount                            
                ])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($partyModel->email)
            ->setBcc('sales@datapacks.in')
            ->setSubject('Order Details for: ' . $this->id . ' from ltm web app')
            ->send();
    }
}