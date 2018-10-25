<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = ucwords($model->name) . ' Business Profile';
// $this->params['breadcrumbs'][] = ['label' => 'Primary Ids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="primary-ids-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= \yii\helpers\Html::a('Third Party Invoices', ['primary-ids/third-party-invoices'], ['class' => 'btn btn-primary']); ?>
    </p>   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'uuid',
            
            
            [
                'attribute' => 'uuid',
                'value' => $model->uuid < 70000 ? $model->uuid = 'New UUID Required': $model->uuid
            ],
            'name',
            'address',
            'city',
            'location',
            'state',
            'pincode',
            'contact_name',
            'phone',
            'whatsapp',
            'email',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
