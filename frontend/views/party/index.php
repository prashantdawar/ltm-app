<?php

$this->title = 'Party';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="party-index">

    <h1><?= \yii\helpers\Html::encode($this->title); ?></h1>

    <p>
        <?= \yii\helpers\Html::a('Create party', ['create'],[
                'class' => 'btn btn-success'
            ]);
        ?>
    </p>

    <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
        ]);
    ?>
</div>