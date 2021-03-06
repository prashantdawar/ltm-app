<?php

namespace frontend\models;

use Yii;

class OrderItem extends \yii\base\Model {



    public $name;
    public $quantity;    

    public function rules(){

        return [
            [['name', 'quantity'], 'required'],
            ['name', 'string'],
            ['quantity', 'integer']
        ];
    }

    
    
    public function attributeLabels(){
    
        return [
            'name' => 'Item Name',
            'quantity' => 'Quantity'
        ];
    }

    public static function find(){
        return parent::find()->andWhere(['`'.strtolower((new \ReflectionClass(static::class))->getShortName()).'`.`created_by`' => \Yii::$app->user->id]);
    }

        /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }
}