<?php

namespace frontend\controllers;

class OrderController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index','update','create','view'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * 
     * List all orders
     */
    public function actionIndex()
    {
        $searchModel = new \frontend\models\OrderSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
      
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Prints pdf
     */
    public function actionPdf($id){

        $model = $this->findModel($id);
        $partyModel = \frontend\models\Party::find()->where(['id' => $model->party_id])->one();
        $firmModel = \frontend\models\PrimaryIds::find()->one();

        $dataItem = [];
        $dataAmount = [];
        foreach($model->item_id as $key => $itemIdQuantity){

            if($key%2 != 0){
                array_push($dataItem, $itemIdQuantity);
                continue;
            }

            $item = \frontend\models\Items::find()->select('name, amount')->where(['id' => $itemIdQuantity])->asArray()->one();
            // var_dump($item); die;
            array_push($dataItem, $item['name']);
            // $amount = \frontend\models\Items::find()->select('amount')->where(['id' => $itemIdQuantity])->asArray()->one();
            array_push($dataAmount,$item['amount']);
        }
        
        return $this->renderPartial('orderpdf',[
            'model' => $model,
            'firmModel' => $firmModel,
            'partyModel' => $partyModel,
            'dataItem' => $dataItem,
            'dataAmount' => $dataAmount
        ]);
        
        // $mpdf = new \Mpdf\Mpdf();
        // $mpdf->WriteHTML(
        //     $this->renderPartial('orderpdf',[
        //         'model' => $model,
        //         'partyModel' => $partyModel,
        //         'dataItem' => $dataItem,
        //         'dataAmount' => $dataAmount
        //     ]));
        // $mpdf->Output();
    }

    /**
     * Prints pdf
     */
    public function actionSendEmail($id){

        $model = $this->findModel($id);
        $partyModel = \frontend\models\Party::find()->where(['id' => $model->party_id])->one();
        $firmModel = \frontend\models\PrimaryIds::find()->one();

        $dataItem = [];
        $dataAmount = [];
        foreach($model->item_id as $key => $itemIdQuantity){

            if($key%2 != 0){
                array_push($dataItem, $itemIdQuantity);
                continue;
            }

            $item = \frontend\models\Items::find()->select('name, amount')->where(['id' => $itemIdQuantity])->asArray()->one();
            // var_dump($item); die;
            array_push($dataItem, $item['name']);
            // $amount = \frontend\models\Items::find()->select('amount')->where(['id' => $itemIdQuantity])->asArray()->one();
            array_push($dataAmount,$item['amount']);
        }
        if(strlen($partyModel->email) > 11) { 
             $model->sendEmail($model, $firmModel,$partyModel, $dataItem, $dataAmount);
        }
        return '<script>window.close();</script>';
    }

    /**
     * Display single order entry
     */
    public function actionView($id){

        $model = $this->findModel($id);

        // var_dump($model->item_id); die;
        // $dataItems = \frontend\models\Items::find()->select('name')->where(['IN', ['id'], $model->item_id])->asArray()->all();
        // $data = [];
        $dataItem = [];
        foreach($model->item_id as $key => $itemIdQuantity){

            if($key%2 != 0){
                array_push($dataItem, $itemIdQuantity);
                continue;
            }

            $item = \frontend\models\Items::find()->select('name')->where(['id' => $itemIdQuantity])->asArray()->one();
            array_push($dataItem, $item['name']);
            
        }
        // var_dump($dataItem); die;
        // foreach ($dataItems as $key => $value) {
        //     $data[] = $value['name'];
        // }
        // $data = implode(' | ', $data);
        
        $data = implode(' | ', $dataItem);

        return $this->render('view',[
            'model' => $model,
            // 'data' => $this->findItem($model->item_id)
            'data' => $data
        ]);
    }

    protected function findModel($id){
        if(($model = \frontend\models\Order::findOne(['id' =>$id])) !== null){
            return $model;
        }

        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    // protected function findItem($item_id){

    //     if(($itemData = \frontend\models\Items::find()->where(['id' => $item_id])->asArray()->one()) !== null){
            
    //         return $itemData;
    //     }

    //     throw new \yii\web\NotFoundHttpException('The requested page does not exist.');        
    // }

   //
    protected function dataAllItems(){
        $itemsData = \frontend\models\Items::find()->select('id ,name, amount')->asArray()->all();

        $data = [];
        foreach ($itemsData as $key => $value) {
            $data['id_name'][$value['id']] = $value['name'];
            $data['id_amount'][$value['id']] = $value['amount'];
        }

        return $data;
    }

    protected function dataAllParties(){
        $partiesData = \frontend\models\Party::find()->select('id,name')->asArray()->all();

        $data = [];
        foreach ($partiesData as $key => $value) {
            $data[$value['id']] = $value['name'];
        }

        return $data;
    }

    /**
     * Create new order entry.
     * Redirects if saved succesfully
     */

     public function actionCreate(){        
         $model = new \frontend\models\Order();
         
         $modelsItem = [new \frontend\models\OrderItem()];
        
         $count = count(\Yii::$app->request->post('OrderItem',[]));
        
         if(!$count) {
            $count = \Yii::$app->request->get('ItemCount');
        }

        for($i = 1; $i < $count; $i++){
            $modelsItem[] =  new \frontend\models\OrderItem();
        }
        
        // var_dump($count); die;
        $itemNameQuantity = [];
        if(\frontend\models\OrderItem::loadMultiple($modelsItem, \Yii::$app->request->post()) && 
            \frontend\models\OrderItem::validateMultiple($modelsItem)){
                
                foreach($modelsItem as $modelItem){
                    // var_dump($value);
                    array_push($itemNameQuantity, $modelItem['name'], $modelItem['quantity']); 
                }
        }
        
         $model->created_at = date('Y-m-d');
         $model->updated_at = date('Y-m-d');

         $model->created_by = \Yii::$app->user->id;
         $model->updated_by = \Yii::$app->user->id;

        $model->item_id = $itemNameQuantity;
             
         if($model->load(\Yii::$app->request->post())){
             if($model->save()){                 
                 $modelPaymentsCredit = new \frontend\models\Payments();                 
                 $modelPaymentsCredit->setAttributes($model->attributes);
                 $modelPaymentsCredit->payment_mode = 1;
                 unset($modelPaymentsCredit->notes);
                //  $modelPaymentsCredit->attributes = $_POST[$model->formName()];
                //  $modelPaymentsCredit->created_at = $model->created_at;
                //  $modelPaymentsCredit->updated_at = $model->updated_at;
                $modelPaymentsCredit->notes = 'Credited for Order No. : ' . $model->oid;
                if($modelPaymentsCredit->save()){
                    if($model->payment_mode != 1){
                        $modelPaymentsDebit = new \frontend\models\Payments();
                        $modelPaymentsDebit->setAttributes($model->attributes);
                        unset($modelPaymentsDebit->notes);
                        // $modelPaymentsDebit->attributes = $_POST[$model->formName()];
                        // $modelPaymentsDebit->created_at = $model->created_at;
                        // $modelPaymentsDebit->updated_at = $model->updated_at;
                        $modelPaymentsDebit->notes = 'Debited for Order No. : ' . $model->oid;
                        $modelPaymentsDebit->save();
                        // if($modelPaymentsDebit->save()){
                        //     $modelParty = \frontend\models\Party::find()->where(['id' => $model->party_id])->one();
                        //     $modelPayments = \frontend\models\Payments::find()->select('amount, payment_mode')->where(['party_id' => $model->party_id])->asArray()->all();;
                            
                        //     $credit =0; $debit = 0;
                        //     foreach($modelPayments as $payments){
                        //         ($payments['payment_mode'] == 1) ? $credit += $payments['amount'] : $debit += $payments['amount'];
                        //     }
                        //     $modelParty->due = $debit - $credit;
                        //     $modelParty->save();
                        // }                        
                    }
                    return $this->redirect(['view', 'id' => $model->id]);         
                }
            }
        } 

        $data['allParties'] = $this->dataAllParties();
        
        // ---for storing item ids.
         $data['allItems'] = $this->dataAllItems();
        // ---        
        // ---for storgin item names.
        //  $datatmp = [];
        //  foreach($this->dataAllItems() as $allItems){ 
        //      $datatmp[$allItems] = $allItems;
        //  }
        //  $data['allItems'] = $datatmp;
        // ---

         return $this->render('create',[
             'model' => $model,
             'modelsItem' => $modelsItem,
             'data' => $data
         ]);
     }

     /**
       * Updates an existing order model.
       * 
       */

      public function actionUpdate($id){

        $model = $this->findModel($id);
       
        $modelsItem = [new \frontend\models\OrderItem()];
        
        $count = count(\Yii::$app->request->post('OrderItem',[]));
        
        if(!\Yii::$app->request->post()){
            $count = $count + count($model->item_id)/2;

            $count = $count + \Yii::$app->request->get('AddItem');        
        }

        for($i = 1; $i < $count; $i++){
            $modelsItem[] =  new \frontend\models\OrderItem();
        }

        if(!\Yii::$app->request->post()){
            foreach($model->item_id as $index => $itemIdQuantity){
                
                if($index%2 !=0){
                    $modelsItem[$index/2]['quantity']= $itemIdQuantity; // here assigns item quantity.
                    continue;
                }
                $modelsItem[$index/2]['name']=$itemIdQuantity; // here assigns item id.
            }
        } else {
            $itemNameQuantity = [];
            if(\frontend\models\OrderItem::loadMultiple($modelsItem, \Yii::$app->request->post()) && 
                \frontend\models\OrderItem::validateMultiple($modelsItem)){
                    
                    foreach($modelsItem as $modelItem){
                        // var_dump($value);
                        array_push($itemNameQuantity, $modelItem['name'], $modelItem['quantity']); 
                    }
            }
            
            $model->updated_at = date('Y-m-d');
            $model->updated_by = \Yii::$app->user->id;
    
            $model->item_id = $itemNameQuantity;
                 
             if($model->load(\Yii::$app->request->post())){
                 if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                 }
            }
        }

        // $model->updated_at = date('Y-m-d');

        $data['allItems'] = $this->dataAllItems();
        $data['allParties'] = $this->dataAllParties();

        return $this->render('update',[
            'model' => $model,
            'modelsItem' => $modelsItem,
            'data' => $data
        ]);
   }
}