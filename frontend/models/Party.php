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
 * @property string $email
 * @property string $street_address
 * @property string $city
 * @property string $location
 * @property string $state
 * @property int $pincode
 * @property int $last_order_id
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
            [['name', 'contact_name', 'phone', 'email', 'street_address', 'city', 'location', 'state', 'pincode', 'last_order_id','gst', 'created_at', 'updated_at'], 'required'],
            [['phone', 'pincode', 'last_order_id', 'status',], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            ['phone', 'string', 'min' => 10, 'max' => 10 ],
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
            'last_order_id' => 'Last Order ID',
            'gst' => 'GSTIN Number',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterFind(){
        
        $this->created_at = date('d-m-Y', strtotime($this->created_at));
        $this->updated_at = date('d-m-Y', strtotime($this->updated_at));

        return true;
    }
}