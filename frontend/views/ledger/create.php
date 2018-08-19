<?php

    $this->title = 'Create Ledger';
    $this->params['breadcrumbs'][] = ['label' => 'Ledger', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="ledger-create">

    <h1><?= \yii\helpers\Html::encode($this->title); ?></h1>

    <?= $this->render('_form',[
        'model' => $model
    ])?>
</div>