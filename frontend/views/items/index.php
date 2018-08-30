<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index">

    <h1><?=  Html::a($this->title, ['/items']); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            // [
            //     'attribute' => 'name',
            //     'label' => 'Item Name',
            //     'format' => 'raw',
            //     // 'value' => 'name' (default fetch from attribute name)
            // ],
            'amount',
            'mrp',
            // 'in_stock',
            // 'status',
            //'created_at',
            
            [   
                'attribute' => 'updated_at', //managed in model
                    'filter' =>  \dosamigos\datepicker\DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'updated_at',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-mm-yyyy'
                            ]
                    ])
            ],
            // [
            //     'attribute' => 'updated_at',
            //     'format' =>['DateTime', 'php:Y-m-d']
            // ],
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
