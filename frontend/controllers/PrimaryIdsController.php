<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PrimaryIds;
use frontend\models\PrimaryIdsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrimaryIdsController implements the CRUD actions for PrimaryIds model.
 */
class PrimaryIdsController extends Controller
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
     * Displays a single PrimaryIds model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProfile(){
        
        return $this->render('view', [
            'model' => $this->findModel(),
        ]);
    }

    /**
     * Finds the PrimaryIds model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PrimaryIds the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel()
    {
        if (($model = PrimaryIds::find()->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}