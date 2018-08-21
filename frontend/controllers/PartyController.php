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
        ];
    }

    /**
     * 
     * List all parties
     */
    public function actionIndex(){

        $query = \frontend\models\Party::find();

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Display a single party entry.
     */
    public function actionView($id){
        
        return $this->render('view',[
            'model' => $this->findModel($id)
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

        if(($model->load(\Yii::$app->request->post())) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update',[
            'model' => $model
        ]);
      }
}