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
                    'value' => 'party.name'
                ],
                [
                    'label' => 'Item Name',
                    'value' => 'items.name'
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