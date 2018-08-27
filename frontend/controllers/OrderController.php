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
     * Display single order entry
     */
    public function actionView($id){

        $model = $this->findModel($id);

        // var_dump($model->item_id); die;
        $dataItems = \frontend\models\Items::find()->select('name')->where(['IN', ['id'], $model->item_id])->asArray()->all();
        // $data = [];
        foreach ($dataItems as $key => $value) {
            $data[] = $value['name'];
        }
        $data = implode(' | ', $data);
        return $this->render('view',[
            'model' => $model,
            // 'data' => $this->findItem($model->item_id)
            'data' => $data
        ]);
    }

    protected function findModel($id){
        if(($model = \frontend\models\Order::findOne($id)) !== null){
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
         $model = new \frontend\models\Order();
         
         $model->created_at = date('Y-m-d H:i:s');
         $model->updated_at = date('Y-m-d H:i:s');

         if($model->load(\Yii::$app->request->post())){
             
             if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
             }
        } 

         $data['allItems'] = $this->dataAllItems();
         $data['allParties'] = $this->dataAllParties();

         return $this->render('create',[
             'model' => $model,
             'data' => $data
         ]);
     }

     /**
       * Updates an existing order model.
       * 
       */

      public function actionUpdate($id){

        $model = $this->findModel($id);
        
        $model->updated_at = date('Y-m-d H:i:s');
        
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