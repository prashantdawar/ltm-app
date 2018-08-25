<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $party_id 
 * @property int $item_id
 * @property int $amount
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Order extends \yii\db\ActiveRecord
{
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
            [[ 'party_id','amount'], 'required'],
            ['item_id', 'required','message' => 'Item Name cannot be blank'],
            [['item_id', 'amount', 'status',  'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe']
            
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
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
}