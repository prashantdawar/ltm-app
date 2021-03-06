<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\party */

$this->title = 'Update Party: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Party', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
