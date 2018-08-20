
<?php
    $this->title = $model->id;
    $this->params['breadcrumbs'][] = ['label' => 'Order', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">
    <h1><?= \yii\helpers\Html::encode($this->title); ?></h1>
    <p>
        <?= \yii\helpers\Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?= \yii\helpers\Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this order?',
                    'method' => 'post'
                ]
            ]);
        ?>
    </p>

    <?= \yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'id',
                    'label' => 'Item name',
                    'value' => $data['name'],

                ],
                'amount',
                'mrp',
                'tax_rate',
                'status',
                'created_at',
                'updated_at'
            ]
        ]);    
    ?>
</div>