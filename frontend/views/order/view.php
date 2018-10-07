
<?php
    $this->title = 'Invoice Number: ' . $model->oid;
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
        <?= \yii\helpers\Html::a('Generate PDF', ['pdf', 'id' => $model->id], ['class' => 'btn btn-primary', 'target' => '_blank']); ?>
        <?php if(strlen($model->party->email) > 11) {?>
            <?= \yii\helpers\Html::a('Send Email', ['send-email', 'id' => $model->id], ['class' => 'btn btn-primary', 'target' => '_blank']); ?>
        <?php } ?>
        
        
        <?php if(strlen($model->party->phone) == 10) {?>
            <a class="btn btn-primary" href="sms:+91<?= $model->party->phone; ?>?body=Your order no.<?= $model->oid?> of amount INR<?= $model->amount?> has been created. For more info contact." target="_blank">Send Sms</a>
        <?php } ?>
        <?php if(strlen($model->party->whatsapp) == 10) {?>
            <a class="btn btn-success" href="https://wa.me/91<?= $model->party->whatsapp; ?>?text=Your order no.<?= $model->oid?> of amount INR<?= $model->amount?> has been created. For more info contact." target="_blank">Send Whatsapp</a>        
        <?php } ?>
        
        <?= \yii\helpers\Html::a('See Party Details', ['party/view', 'id' => $model->party_id], ['class' => 'btn btn-primary', 'style' => 'float: right; clear: both']); ?>
    </p>
    
    <?= \yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'party_id',
                [
                    'attribute' => 'party.name',
                    'label' => 'Party Name'
                ],
                // [
                //     'attribute' => 'id',
                //     'label' => 'Item name',
                //     'value' => $data['name'],

                // ],
                // [
                //     'attribute' => 'items.name',
                //     'label' => 'Item Name',
                // ],
                [
                    'attribute' => 'item_id',
                    'label' => 'Item Name',
                    'format' =>'raw',
                    'value' => $data
                 ],
                [
                    'attribute' => 'amount',
                    'format'=> 'raw',
                    'value' => $model->currencySymbol.' '.$model->amount,
                ],
                [
                    'attribute' => 'payment_mode',
                    'value' => $model->paymentMode[$model->payment_mode],
                ],
                [
                    'attribute' => 'status',
                    'value' => $model->orderStatus[$model->status],

                ],  
                [
                    'attribute' => 'notes',
                    'value' => (strlen($model->notes) > 0) ? $model->notes : '--- Click Update to enter notes. ---'
                ],              
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
            ]
        ]);    
    ?>
</div>
<?php //$this->registerJs('$(document).ready(function(){ window.open("/order/pdf?id='.$model->id.'","_blank");});'); ?>