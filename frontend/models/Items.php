<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property string $name
 * @property int $amount
 * @property int $mrp
 * @property int $in_stock
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'amount', 'mrp', 'created_at', 'updated_at', 'tax_rate'], 'required'],
            [['amount', 'mrp', 'tax_rate','in_stock', 'status', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'safe'],
            [['tax_rate'], 'default', 'value' => 0]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Item Name',
            'amount' => 'Selling Price',
            'mrp' => 'Mrp',
            'tax_rate' => 'Tax Rate ( % )',
            'in_stock' => 'In Stock',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public static function find(){
        return parent::find()->andWhere(['`'.strtolower((new \ReflectionClass(self::class))->getShortName()).'`.`created_by`' => \Yii::$app->user->id]);
    }

    // https://stackoverflow.com/q/42021165 // the GridView Filter calls beforeValidate() and the uses these values for a filter...
    // https://stackoverflow.com/a/42021681 // in gridview $this->validate() is called, so updated_at and updated_by fields are auto updated for each row.
    // public function beforeValidate(){
    //     if(!parent::beforeValidate()){
    //         return false;
    //     }
        
    //     if($this->isNewRecord){
    //         $this->created_at = date('Y-m-d');
    //         $this->created_by = \Yii::$app->user->id;
    //     }
    //     die;
    //     $this->updated_at = date('Y-m-d'); 
    //     $this->updated_by = \Yii::$app->user->id;
        
    //     return true;
    // }
    
    public function beforeSave($insert){
        
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->created_at = date('Y-m-d', strtotime($this->created_at));
        $this->updated_at = date('Y-m-d', strtotime($this->updated_at));

        return true;
    }

    public function afterFind(){
        
        $this->created_at = date('d-m-Y', strtotime($this->created_at));
        $this->updated_at = date('d-m-Y', strtotime($this->updated_at));

        return true;
    }
}