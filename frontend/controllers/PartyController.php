<?php

namespace frontend\controllers;

class PartyController extends \yii\web\Controller {

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
     * List all parties
     */
    public function actionIndex(){

        $searchModel = new \frontend\models\PartySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Display a single party entry.
     */
    public function actionView($id){

        $query = \frontend\models\Order::find();
        $netAmount['credit'] = (float)($query->where('party_id=:partyId')->addParams([':partyId' => $id])->andwhere(['payment_mode' => '1'])->sum('amount'));
        $netAmount['debit'] = (float)($query->where('party_id=:partyId')->addParams([':partyId' => $id])->andwhere(['not',['payment_mode' => '1']])->sum('amount'));        
        // var_dump($netAmount['debit']); die;
        return $this->render('view',[
            'model' => $this->findModel($id),
            'netAmount' => $netAmount
        ]);
    }

    protected function findModel($id){

        if(($model = \frontend\models\Party::findOne($id)) !== null){
            return $model;
        }

        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Create a new party entry
     */

     public function actionCreate(){
         $model = new \frontend\models\Party();

         $model->last_order_id = 0;
         
         $model->created_at = date('Y-m-d H:i:s');
         $model->updated_at = date('Y-m-d H:i:s');

         if(($model->load(\Yii::$app->request->post())) && $model->save()){
             return $this->redirect(['view', 'id' => $model->id]);
         }

         return $this->render('create',[
            'model' => $model,
         ]);
     }

     /**
      * Update and existing party model
      */
      public function actionUpdate($id){

        $model = $this->findModel($id);
        
        $model->updated_at = date('Y-m-d H:i:s');
        
        if(($model->load(\Yii::$app->request->post())) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update',[
            'model' => $model
        ]);
      }
}