<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Ledger;
use frontend\models\LedgerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class LedgerController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * List all ledger 
     */

     public function actionIndex(){
         $searchModel = new LedgerSearch();
         $dataProvider = $searchModel->search(
             Yii::$app->request->queryParams
         );

         return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
         ]);
     }

     /**
      * Display single ledger entry
      */
      public function actionView($id){

        return $this->render('view',[
            'model' => $this->findModel($id)
        ]);
      }

      /**
       * Creates a new ledger entry.
       * Redirects if saved succesfully.
       */
      public function actionCreate(){
          
        $model = new Ledger();

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }
        // var_dump($model->errors);
        return $this->render('create',[
            'model' => $model
        ]);
      }

      
      /**
       * Find the ledger model based on its primary key value.
       * If the model is not found, a 404 HTTP exception will be thrown.
       * 
       */

       protected function findModel($id){

            if(($model = Ledger::findOne($id)) !== null){
                return $model;
            }

            throw new NotFoundHttpException('The requestes page does not exist.');
       }
}