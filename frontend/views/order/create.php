<?php

    $this->title = 'Create Invoice';
    $this->params['breadcrumbs'][] = ['label' => 'Order', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="dropdown">
<a href="#" data-toggle="dropdown" class="dropdown-toggle">No. of items <b class="caret"></b></a>

</div>


<div class="order-create">

    <h1><?= \yii\helpers\Html::encode($this->title); ?></h1>

    <?= $this->render('_form',[
        'model' => $model,
        'modelsItem' => $modelsItem,
        'data' => $data
    ])?>
</div>