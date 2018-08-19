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
        
        return $this->render('view',[
            'model' => $this->findModel($id)
        ]);
    }

    protected function findModel($id){
        if(($model = \frontend\models\Order::findOne($id)) !== null){
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Create new order entry.
     * Redirects if saved succesfully
     */

     public function actionCreate(){
         $model = new \frontend\models\Order();

         if($model->load(\Yii::$app->request->post()) && $model->save()){
             return $this->redirect(['view', 'id' => $model->id]);
         }

         return $this->render('create',[
             'model' => $model
         ]);
     }
}