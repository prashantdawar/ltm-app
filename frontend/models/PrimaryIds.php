<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "primary_ids".
 *
 * @property int $id
 * @property int $item_id
 * @property int $party_id
 * @property int $payments_id
 * @property int $order_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $location
 * @property string $state
 * @property int $pincode
 * @property string $contact_name
 * @property string $phone
 * @property string $whatsapp
 * @property string $email 
 */
class PrimaryIds extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'primary_ids';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [['item_id', 'party_id', 'payments_id', 'order_id', 'created_by', 'updated_by', 'pincode'], 'integer'],
           [['created_at', 'updated_at', 'created_by', 'updated_by', 'name', 'address', 'city', 'location', 'state', 'pincode', 'contact_name', 'phone', 'whatsapp', 'email'], 'required'],
           [['created_at', 'updated_at'], 'safe'],
           [['name', 'address', 'city', 'location', 'state', 'contact_name', 'email'], 'string', 'max' => 255],
           [['phone', 'whatsapp'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'party_id' => 'Party ID',
            'payments_id' => 'Payments ID',
            'order_id' => 'Order ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'name' => 'Name',
            'address' => 'Address',
            'city' => 'City',
            'location' => 'Location',
            'state' => 'State',
            'pincode' => 'Pincode',
            'contact_name' => 'Contact Name',
            'phone' => 'Phone',
            'whatsapp' => 'Whatsapp',
            'email' => 'Email',
        ];
    }

    public static function find(){
        return parent::find()->andWhere(['`'.strtolower(self::tableName()).'`.`created_by`' => \Yii::$app->user->id]);
    }
}
