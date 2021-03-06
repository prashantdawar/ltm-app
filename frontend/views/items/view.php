<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'amount',
            'mrp',
            'tax_rate',
            // [
            //     'attribute' => 'tax_rate',
            //     'value' => function($model){
            //         return $model->tax_rate . ' %';
            //     }
            // ],
            // 'in_stock',
            // 'status',
            'created_at', //managed in model
            // [
            //     'attribute' => 'created_at',
            //     'format' =>['DateTime', 'php:Y-m-d']
            // ],
            'updated_at', //managed in model
            // [
            //     'attribute' => 'updated_at',
            //     'format' =>['DateTime', 'php:Y-m-d']
            // ],
        ],
    ]) ?>

</div>
