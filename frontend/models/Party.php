<?php

namespace app\models;

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
 * @property string $pan
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
            [['name', 'contact_name', 'phone', 'email', 'street_address', 'city', 'location', 'state', 'pincode', 'last_order_id', 'gst', 'pan', 'created_at', 'updated_at'], 'required'],
            [['phone', 'pincode', 'last_order_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'contact_name', 'email', 'street_address', 'city', 'location', 'state', 'gst', 'pan'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'contact_name' => 'Contact Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'street_address' => 'Street Address',
            'city' => 'City',
            'location' => 'Location',
            'state' => 'State',
            'pincode' => 'Pincode',
            'last_order_id' => 'Last Order ID',
            'gst' => 'Gst',
            'pan' => 'Pan',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
