<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = ucwords($model->name) . ' Business Profile';
// $this->params['breadcrumbs'][] = ['label' => 'Primary Ids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="primary-ids-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'uuid',            
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
