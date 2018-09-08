
<?php
    $this->title = $model->name;
    $this->params['breadcrumbs'][] = ['label' => 'Party', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>




<?php
  $creditBalance = ($netAmount['credit']) ? $netAmount['credit'] : 0;
  $debitBalance = ($netAmount['debit']) ? $netAmount['debit'] : 0;
  $netBalance = $debitBalance - $creditBalance;
?>
<div class="party-view">
    <div class="col-md-6">
    <h1><?= \yii\helpers\Html::encode($this->title); ?></h1>
    <p>
        <?= \yii\helpers\Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?= \yii\helpers\Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this party?',
                    'method' => 'post'
                ]
            ]);
        ?>
    </p>
    </div>


    <div class="col-md-6">
        <p>
            <div class="alert alert-success" role="alert">
                <table style="display: inline;">
                <tbody>
                    <tr>
                        <th>
                            <span>Net Debit:</span>
                        </th>
                        <td>
                            <span> &#x20B9;</span>
                            <span><?= $debitBalance?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span> Net Credit: </span>
                        </th>
                        <td>
                            <span> &#x20B9;</span>
                            <span><?= $creditBalance?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span>Net <?= ($netBalance >= 0) ? 'Debit': 'Credit'?> Balance:</span>
                        </th>
                        <td>
                            <span> &#x20B9;</span>
                            <span><?=  $netBalance ?></span>
                        </td>
                    </tr>
                </tbody>
                </table>
                <div style="display:inline; float: right;">
                    <?= \yii\helpers\Html::a('See Orders', ['order/', 'OrderSearch[party_name]' => $model->name], ['class' => 'btn btn-primary']); ?>
                </div>
            </div>
        </p>
    
    </div>
    <?= \yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'contact_name',
                'phone',
                'email',
                'street_address',
                'city',
                'location',
                'state',
                'pincode',
                'gst',
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