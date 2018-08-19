<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ledger".
 *
 * @property int $id
 * @property int $party_id
 * @property int $order_id
 * @property int $amount
 * @property string $mode_of_payment
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Ledger extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ledger';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['party_id', 'order_id', 'amount', 'mode_of_payment'], 'required'],
            [['party_id', 'order_id', 'amount', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['mode_of_payment'], 'string', 'max' => 255],
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
            'order_id' => 'Order ID',
            'amount' => 'Amount',
            'mode_of_payment' => 'Mode Of Payment',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
