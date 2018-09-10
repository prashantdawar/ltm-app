<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Payments */

$this->title = $model->party->name;
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-view">

    <h1><?= Html::encode('Payments: ' . $this->title) ?></h1>

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
            // 'id',
            // 'party_id',
            [
                'attribute' => 'party.name',
                'label' => 'Party Name'
            ],
            [
                'attribute' => 'payment_mode',
                'value' => $model->paymentMode[$model->payment_mode],
            ],
            [
                'attribute' => 'amount',
                'format'=> 'raw',
                'value' => $model->currencySymbol.' '.$model->amount,
            ],
            [
                'attribute' => 'notes',
                'format'=> 'raw',
                'value' => (strlen($model->notes) > 0) ? $model->notes : '--- Click Update to enter notes. ---'
            ],
            'created_at',
            'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

</div>
