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
        ];
    }

    /**
     * 
     * List all orders
     */
    public function actionIndex()
    {
        $query = \frontend\models\Order::find();

        // $partyModel = new \frontend\models\Party();

        // $query->joinWith(['party']);
        // $query->andFilterWhere([
        //     'LIKE',
        //     'party.name',
        //     $partyModel->getAttribute('party.name')
        // ]);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query
        ]);        
        
        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Display single order entry
     */
    public function actionView($id){

        $model = $this->findModel($id);

        return $this->render('view',[
            'model' => $model,
            'data' => $this->findItem($model->item_id)
        ]);
    }

    protected function findModel($id){
        if(($model = \frontend\models\Order::findOne($id)) !== null){
            return $model;
        }

        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    protected function findItem($item_id){

        if(($itemData = \frontend\models\Items::find()->where(['id' => $item_id])->asArray()->one()) !== null){
            
            return $itemData;
        }

        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');        
    }

   //
    protected function dataAllItems(){
        $itemsData = \frontend\models\Items::find()->select('id ,name')->asArray()->all();

        foreach ($itemsData as $key => $value) {
            $data[$value['id']] = $value['name'];
        }

        return $data;
    }

    protected function dataAllParties(){
        $partiesData = \frontend\models\Party::find()->select('id,name')->asArray()->all();

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
         $orderModel = new \frontend\models\Order();

         if($orderModel->load(\Yii::$app->request->post()) && $orderModel->save()){
             return $this->redirect(['view', 'id' => $orderModel->id]);
         }

         $data['allItems'] = $this->dataAllItems();
         $data['allParties'] = $this->dataAllParties();
        // var_dump($orderModel->errors); die;
         return $this->render('create',[
             'model' => $orderModel,
             'data' => $data
         ]);
     }

     /**
       * Updates an existing order model.
       * 
       */

      public function actionUpdate($id){

        $model = $this->findModel($id);

        if(($model->load(\Yii::$app->request->post())) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $data['allItems'] = $this->dataAllItems();
        $data['allParties'] = $this->dataAllParties();

        return $this->render('update',[
            'model' => $model,
            'data' => $data
        ]);
   }
}