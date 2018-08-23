<?php

$this->title = 'Order';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="order-index">

    <h1><?= \yii\helpers\Html::encode($this->title); ?></h1>

    <p>
        <?= \yii\helpers\Html::a('Create Order', ['create'],[
                'class' => 'btn btn-success'
            ]);
        ?>
    </p>

    <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'label' => 'Party Name',
                    'format' => 'raw',
                    'value' => function($model) {
                                
                                return \yii\helpers\Html::a(
                                    $model->party->name,
                                    \yii\helpers\Url::to(['party/view', 'id' => $model->party->id]),
                                    ['target' => '_blank']);
                                }
                ],
                [
                    'attribute' => 'items.name',
                    'label' => 'Item Name',
                    'format' => 'raw',
                    'value' => function($model) {
                                
                                return \yii\helpers\Html::a(
                                    $model->items->name,
                                    \yii\helpers\Url::to(['items/view', 'id' => $model->items->id]),
                                    ['target' => '_blank']);
                                }
                ],
                'amount',
                'mrp',
                'tax_rate',
                'status',

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    ?>
</div>