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
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['profile'],
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


    public function actionThirdPartyInvoices(){

        $model = $this->findModel();

        if($model->uuid != 0){

            $partyModels = \frontend\models\Party::find()->select('id, created_by')->where(['uuid' => $model->uuid])->all();
            // var_dump($partyModels); die;
            $thirdPartyInvoices = [];

            foreach ($partyModels as $partyModel) {

                $orderArray = \frontend\models\Order::find()
                                    ->select('oid, amount, created_at, created_by')
                                    ->where(['party_id' => $partyModel->id, 'created_by' => $partyModel->created_by])
                                    ->orderBy('created_at DESC')
                                    ->asArray()->all();

                foreach($orderArray as $order){
                    $thirdPartyInvoice = new \frontend\models\ThirdPartyInvoices();
                    $thirdPartyInvoice->oid = $order['oid'];
                    $thirdPartyInvoice->amount = $order['amount'];
                    $thirdPartyInvoice->created_at = date('d-m-Y', strtotime($order['created_at']));
                    $modelPrimaryIds = \frontend\models\PrimaryIds::find()->select('name')->where(['created_by' => $order['created_by']])->asArray()->one();
                    $thirdPartyInvoice->created_by = $modelPrimaryIds['name'];
                    // var_dump($thirdPartyInvoice->validate()); die;
                    // \frontend\models\OrderItem::loadMultiple($thirdPartyInvoices, $thirdPartyInvoice);
                    // $thirdPartyInvoices[] = $thirdPartyInvoice;
                    array_push($thirdPartyInvoices, $thirdPartyInvoice);
                }
            }       
        }
        // for( $i =0; $i < count($thirdPartyInvoices); $i++){
        //     $invoices[] = new \frontend\models\ThirdPartyInvoices();
        // }
        
        // foreach($thirdPartyInvoices as $invoice){
        //     // var_dump($invoice->validate()); die;
        //     array_push($invoices, $invoice);
        // }

        // $invoices = [new \frontend\models\ThirdPartyInvoices()];
        
        // var_dump(\frontend\models\ThirdPartyInvoices::loadMultiple($invoices, $thirdPartyInvoices));
        // var_dump(\frontend\models\ThirdPartyInvoices::validateMultiple($invoices));die;
        
        return $this->render('thirdPartyInvoices',[
            'invoices' => $thirdPartyInvoices,
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