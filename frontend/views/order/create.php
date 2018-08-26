<?php

    $this->title = 'Create Invoice';
    $this->params['breadcrumbs'][] = ['label' => 'Order', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="order-create">

    <h1><?= \yii\helpers\Html::encode($this->title); ?></h1>

    <?= $this->render('_form',[
        'model' => $model,
        'data' => $data
    ])?>
</div>