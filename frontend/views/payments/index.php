<?php

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;

?>




<?php
  $totalCredit = ($netAmount['totalCredit']) ? $netAmount['totalCredit'] : 0;
  $totalDebit = ($netAmount['totalDebit']) ? $netAmount['totalDebit'] : 0;
  $totalNet = $totalDebit - $totalCredit;

  $thisWeekCredit = ($netAmount['thisWeekCredit']) ? $netAmount['thisWeekCredit'] : 0;
  $thisWeekDebit = ($netAmount['thisWeekDebit']) ? $netAmount['thisWeekDebit'] : 0;
  $thisWeekNet = $thisWeekDebit - $thisWeekCredit;

  $todayCredit = ($netAmount['todayCredit']) ? $netAmount['todayCredit'] : 0;
  $todayDebit = ($netAmount['todayDebit']) ? $netAmount['todayDebit'] : 0;
  $todayNet = $todayDebit - $todayCredit;
?>

<div class="payments-index">

    <div class="col-md-6">
    <h1><?= \yii\helpers\Html::a($this->title, ['/payments']); ?></h1>

    <p>
        <?= \yii\helpers\Html::a('Create Payments', ['create'], ['class' => 'btn btn-success']) ?>

        <?= \yii\helpers\Html::a('Show Report', ['#tablepayments'], ['class' => 'btn btn-primary hidden-md hidden-lg ', 'data-toggle' =>'collapse']) ?>
    </p>
    </div>
    <div class="collapse col-md-6" id="tablepayments">
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
                                <span><?= $totalDebit?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span> Net Credit: </span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?= $totalCredit?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span>Due Balance:</span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?=  $totalNet ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="display: inline;  margin-right: 25px;">
                    <tbody>
                        <tr>
                            <th><span style="color: #337ab7;">Last 7 Days</span></th>
                        </tr>                    
                        <tr>
                            <th>
                                <span>Net Debit:</span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?= $thisWeekDebit; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span> Net Credit: </span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?= $thisWeekCredit; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span>Due Balance:</span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?= $thisWeekNet; ?></span>
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
                                <span><?= $todayDebit; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span> Net Credit: </span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?= $todayCredit; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <span>Due Balance:</span>
                            </th>
                            <td>
                                <span> &#x20B9;</span>
                                <span><?=  $todayNet; ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </p>
    
    </div>
    <div style="clear:both;"></div>
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
