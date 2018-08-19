

<div class="ledger-form">
    <?php $form = \yii\widgets\ActiveForm::begin(); ?>

        <?= $form->field($model, 'party_id')->textInput(); ?>
        <?= $form->field($model, 'order_id')->textInput(); ?>
        <?= $form->field($model, 'amount')->textInput(); ?>
        <?= $form->field($model, 'mode_of_payment')->textInput(); ?>

        <div class="form-group">
            <?= \yii\helpers\Html::submitButton('Save',['class' => 'btn btn-success']); ?>
        </div>
    <?php \yii\widgets\ActiveForm::end(); ?>
</div>