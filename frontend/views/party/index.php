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
                // 'phone',
                // 'email',
                // 'street_address',
                'city',
                // 'location',
                // 'state',
                // 'pincode',
                [
                    'label' => 'Orders',
                    'format' => 'raw',
                    'value' => function($model) {                                
                                return \yii\helpers\Html::a(
                                    'Show Details',
                                    \yii\helpers\Url::to(['order/', 'OrderSearch[party_name]' => $model->name]));
                                }
                ],
                'gst',
                // 'pan',
                // 'status',

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    ?>
</div>