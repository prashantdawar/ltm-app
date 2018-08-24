<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Items */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'mrp')->textInput() ?>

    <?= $form->field($model, 'in_stock')->hiddenInput(['value'=> 10])->label(false); ?>

    <?= $form->field($model, 'status')->hiddenInput(['value'=> 10])->label(false); ?>

    <?= $form->field($model, 'created_at')->hiddenInput(['value'=> 10])->label(false); ?>

    <?= $form->field($model, 'updated_at')->hiddenInput(['value'=> 10])->label(false); ?>

    <?= $form->field($model, 'created_by')->hiddenInput(['value'=> 10])->label(false); ?>

    <?= $form->field($model, 'updated_by')->hiddenInput(['value'=> 10])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
