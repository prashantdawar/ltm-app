<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Payments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payments-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'party_id')->widget(\kartik\select2\Select2::classname(), [
            'data' => $data['allParties'],
            'options' => ['placeholder' => 'Select a party ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    
    
    <?= $form->field($model, 'payment_mode')->widget(\kartik\select2\Select2::classname(), [
            'hideSearch' => true,
            'data' => $model->paymentMode,
            'options' => ['placeholder' => 'Select payment mode ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'notes')->textArea() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
