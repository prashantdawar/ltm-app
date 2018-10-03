<?php

$this->title = 'Order';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="order-index">

    <h1><?= \yii\helpers\Html::a($this->title, ['/order']); ?></h1>

    <p>
        <?= \yii\helpers\Html::a('Create Invoice', ['create'],[
                'class' => 'btn btn-success'
            ]);
        ?>
    </p>

    <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                // 'party_id','item_id',                
                [
                    'attribute' => 'party_name',
                    'headerOptions' => ['style' => 'width:20%'],
                    'label' => 'Party Name',
                    'format' => 'raw',
                    // 'value' => 'party.name',
                    'value' => function($model) {
                                
                                return \yii\helpers\Html::a(
                                    $model->party->name,
                                    \yii\helpers\Url::to(['/order', 'OrderSearch[party_id]' => $model->party_id, 'OrderSearch[party_name]' => $model->party->name]));
                                    // \yii\helpers\Url::to(['.', 'OrderSearch[party_name]' => $model->party->name]));
                                    
                                    // \yii\helpers\Url::to(['party/view', 'id' => $model->party->id]),
                                    // ['target' => '_blank']);
                                }
                ],
                // 'id',
                [
                    'attribute' => 'oid',
                    'headerOptions' => ['style' => 'width:11%;'],
                    'contentOptions' =>['style' => 'text-align: center;'],
                    'label' => 'Invoice No.',
                    'format' => 'raw',
                    'value' => function($model) {
                                
                                return \yii\helpers\Html::a(
                                    $model->oid,
                                    \yii\helpers\Url::to(['order/view', 'id' => $model->id]),
                                    ['style' => 'display:block; width: 100%; height: 100%;']);
                                }                    
                ],
                // [
                //     'attribute' => 'item_name',
                //     'label' => 'Item Name',
                //     'format' => 'raw',
                //     'value' => 'items.name',
                //     // 'value' => function($model) {
                                
                //     //             return \yii\helpers\Html::a(
                //     //                 $model->items->name,
                //     //                 \yii\helpers\Url::to(['items/view', 'id' => $model->items->id]),
                //     //                 ['target' => '_blank']);
                //     //             }
                // ],
                'amount',
                [   'attribute' => 'status',
                    'filter' =>  \kartik\select2\Select2::widget([
                        'model' => $searchModel,
                        'data' => $searchModel->orderStatus,
                        'attribute' => 'status',
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]),
                    'value' => function($model){
                        return $model->orderStatus[$model->status];
                    },
                    'headerOptions' => ['style' => ' min-width:150px;  '],
                ],                
                // 'status',
                [   'attribute' => 'payment_mode',
                    'filter' =>  \kartik\select2\Select2::widget([
                        'model' => $searchModel,
                        'data' => $searchModel->paymentMode,
                        'attribute' => 'payment_mode',
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]),
                    'value' => function($model){
                        return $model->paymentMode[$model->payment_mode];
                    },
                    'headerOptions' => ['style' => ' min-width:180px;  '],
                ],
                // 'created_at', //managed in model
                

                // [
                //     'attribute' => 'created_at',
                //     'format' => 'raw',
                //     'filter' => \kartik\date\DatePicker::widget([
                //             'model' => $searchModel,
                //             'name' => 'OrderSearch[created_at]',
                //             'type' => \kartik\date\DatePicker::TYPE_INPUT,
                //             'attribute' => 'created_at',
                //             'pluginOptions' => [
                //                 'autoclose'=>true,
                //                 'format' => 'dd-mm-yyyy',
                //             ]
                //     ])
                // ],
                [   'attribute' => 'created_at',
                    'filter' =>  \dosamigos\datepicker\DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'created_at',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy'
                            ]
                    ])
                ],
                // [
                //     'attribute' => 'created_at',
                //     'format' =>['DateTime', 'php:Y-m-d']
                // ],

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    ?>
</div>