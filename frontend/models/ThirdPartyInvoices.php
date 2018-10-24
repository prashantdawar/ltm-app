<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class Third Party Invoices.
 * 
 * @property int $oid
 * @property int $amount
 * @property string $created_at
 * @property int $created_by
 */

class ThirdPartyInvoices extends \yii\base\Model {

    public $oid;
    public $amount;
    public $created_by;
    public $created_at;

    
    public function rules (){


        return [
            [['oid', 'amount', 'created_at', 'created_by'], 'required']
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'oid' => 'Invoice No.',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'created_by' => 'created_by'
        ];
    }
}