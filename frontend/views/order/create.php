<?php

    $this->title = 'Create Invoice';
    $this->params['breadcrumbs'][] = ['label' => 'Order', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="dropdown">
<a href="#" data-toggle="dropdown" class="dropdown-toggle">No. of items <b class="caret"></b></a>
<?php
    echo \yii\bootstrap\Dropdown::widget([
        'items' => [
            ['label' => '1', 'url' => '?ItemCount=1'],
            ['label' => '2', 'url' => '?ItemCount=2'],
            ['label' => '3', 'url' => '?ItemCount=3'],
            ['label' => '4', 'url' => '?ItemCount=4'],
            ['label' => '5', 'url' => '?ItemCount=5'],
            ['label' => '6', 'url' => '?ItemCount=6'],
            ['label' => '7', 'url' => '?ItemCount=7'],
        ],
    ]);
?>
</div>


<div class="order-create">

    <h1><?= \yii\helpers\Html::encode($this->title); ?></h1>

    <?= $this->render('_form',[
        'model' => $model,
        'modelsItem' => $modelsItem,
        'data' => $data
    ])?>
</div>