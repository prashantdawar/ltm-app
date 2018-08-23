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
 * @property int $mrp
 * @property int $tax_rate
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
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
            [[ 'party_id','amount', 'mrp', 'created_at', 'updated_at'], 'required'],
            ['item_id', 'required','message' => 'Item Name cannot be blank'],
            [['item_id', 'amount', 'mrp', 'tax_rate', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            
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
            'amount' => 'Amount',
            'mrp' => 'Mrp',
            'tax_rate' => 'Tax Rate',
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