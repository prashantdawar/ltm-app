<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = 'Update Invoice: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Invoice Number: ' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="dropdown">
<a href="#" data-toggle="dropdown" class="dropdown-toggle">Add items <b class="caret"></b></a>
<?php
    echo \yii\bootstrap\Dropdown::widget([
        'items' => [
            ['label' => '1', 'url' => '?id='.$model->id.'&AddItem=1'],
            ['label' => '2', 'url' => '?id='.$model->id.'&AddItem=2'],
            ['label' => '3', 'url' => '?id='.$model->id.'&AddItem=3'],
            ['label' => '4', 'url' => '?id='.$model->id.'&AddItem=4'],
            ['label' => '5', 'url' => '?id='.$model->id.'&AddItem=5'],
            ['label' => '6', 'url' => '?id='.$model->id.'&AddItem=6'],
            ['label' => '7', 'url' => '?id='.$model->id.'&AddItem=7'],
        ],
    ]);
?>
</div>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsItem' => $modelsItem,
        'data' => $data
    ]) ?>

</div>