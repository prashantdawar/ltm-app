
<?php
    $this->title = $model->id;
    $this->params['breadcrumbs'][] = ['label' => 'Party', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="party-view">
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

    <?= \yii\widgets\DetailView::widget([
            'model' => $model,
        ]);    
    ?>
</div>