<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Items */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'mrp')->textInput([ 'type' => 'number', 'autocomplete' => 'off']) ?>
    
    <?= $form->field($model, 'tax_rate')->textInput([ 'type' => 'number', 'autocomplete' => 'off']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
