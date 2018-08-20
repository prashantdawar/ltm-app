<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Ledger';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="ledger-index">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Create Ledger',['create'],['class' => 'btn btn-success'])?>
    </p>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'party_id',
                'order_id',
                'amount',
                'mode_of_payment',
                'created_at',
                'status',

                ['class' => 'yii\grid\ActionColumn'],
            ]
        ]);
    
    ?>
</div>