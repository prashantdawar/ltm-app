<?php

$this->title = 'Create Party';
$this->params['breadcrumbs'][] = [
    'label' => 'Party',
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="party-create">

    <h1><?= \yii\helpers\Html::encode($this->title); ?></h1>

    <?= $this->render('_form',[
            'model' => $model
        ]);

    ?>
</div>