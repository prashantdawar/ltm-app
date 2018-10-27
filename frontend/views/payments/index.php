<?php

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;

?>




<?php
  $creditBalance = ($netAmount['credit']) ? $netAmount['credit'] : 0;
  $debitBalance = ($netAmount['debit']) ? $netAmount['debit'] : 0;
  $netBalance = $debitBalance - $creditBalance;
?>

<div class="payments-index">

    <div class="col-md-6">
    <h1><?= \yii\helpers\Html::a($this->title, ['/payments']); ?></h1>

    <p>
        <?= \yii\helpers\Html::a('Create Payments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>
    <div class="col-md-6">
        <p>
            <div class="alert alert-success" role="alert">
                <table style="display: inline; margin-right: 25px;">
                    <tbody>
                        <tr>
                            <th><span style="color: #337ab7;">Total</span></th>
                        </tr>
                        <tr>
                            <th>
                                <span>Net Debit:</span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?= $debitBalance?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span> Net Credit: </span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?= $creditBalance?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span>Due Balance:</span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?=  $netBalance ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="display: inline;  margin-right: 25px;">
                    <tbody>
                        <tr>
                            <th><span style="color: #337ab7;">This Week</span></th>
                        </tr>                    
                        <tr>
                            <th>
                                <span>Net Debit:</span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?= $debitBalance?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span> Net Credit: </span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?= $creditBalance?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span>Due Balance:</span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?=  $netBalance ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="display: inline;">
                    <tbody>
                        <tr>
                            <th><span style="color: #337ab7;">Today</span></th>
                        </tr>                    
                        <tr>
                            <th>
                                <span>Net Debit:</span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?= $debitBalance?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span> Net Credit: </span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?= $creditBalance?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span>Due Balance:</span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?=  $netBalance ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </p>
    
    </div>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'party_name',
                'headerOptions' => ['style' => 'width:20%'],
                'label' => 'Party Name',
                'format' => 'raw',
                // 'value' => 'party.name',
                'value' => function($model) {                            
                        return \yii\helpers\Html::a(
                            $model->party->name,
                            \yii\helpers\Url::to(['/payments', 'PaymentsSearch[party_id]' => $model->party_id, 'PaymentsSearch[party_name]' => $model->party->name]));
                        }
            ],
            [
                'attribute' => 'pid',
                'headerOptions' => ['style' => 'width:11%;'],
                'contentOptions' =>['style' => 'text-align: center;'],
                'format' => 'raw',
                'value' => function($model) {
                            
                            return \yii\helpers\Html::a(
                                $model->pid,
                                \yii\helpers\Url::to(['payments/view', 'id' => $model->id]),
                                ['style' => 'display:block; width: 100%; height: 100%;']);
                            }                    
            ],
            'amount',
            [   'attribute' => 'payment_mode',
                'filter' =>  \kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'hideSearch' => true,
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
            //'updated_at',
            //'created_by',
            //'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}'
            ],
        ],
    ]); ?>
</div>
