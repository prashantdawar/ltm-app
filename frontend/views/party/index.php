<?php

$this->title = 'Party';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="party-index">

    <h1><?=  \yii\helpers\Html::a($this->title, ['/party']); ?></h1>

    <p>
        <?= \yii\helpers\Html::a('Create party', ['create'],[
                'class' => 'btn btn-success'
            ]);
        ?>
    </p>

    <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                // 'contact_name',                
                // 'email',
                // 'street_address',
                'city',
                // 'location',
                // 'state',
                // 'pincode',
                [
                    'label' => 'Orders (Count)',
                    'format' => 'raw',
                    'value' => function($model) {                                
                                return \yii\helpers\Html::a(
                                    'Show Details ('. $model->total_orders.')',
                                    \yii\helpers\Url::to(['order/', 'OrderSearch[party_id]' => $model->id, 'OrderSearch[party_name]' => $model->name]));
                                }
                ],
                
                [
                    'attribute' => 'due',
                    'filter' =>  \kartik\select2\Select2::widget([
                        'model' => $searchModel,
                        'hideSearch' => true,
                        'data' => $searchModel->due_condition_options,
                        'attribute' => 'due_condition',
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]),
                    'headerOptions' => ['style' => ' min-width:150px;  '], 
                ],
                [
                    'attribute' => 'phone',
                    'format' => 'raw',
                    'value' => function($model){
                        return (strlen($model->phone) == 10) ? '<a class="btn btn-primary" href="tel:+91'.$model->phone.'" target="_blank" style="margin-right: 0.5em;">Call</a>'.$model->phone : $model->phone;
                    }
                ],
                // 'gst',
                // 'pan',
                // 'status',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update}'
                ],
            ]
        ]);
    ?>
</div>