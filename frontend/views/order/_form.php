
<div class="order-form">
    <?php $form = \yii\widgets\ActiveForm::begin(); ?>

        <?=$form->field($model,'item_id')->textInput(); ?>
        <?=$form->field($model,'amount')->textInput(); ?>
        <?=$form->field($model,'mrp')->textInput(); ?>
        <?=$form->field($model,'tax_rate')->textInput(); ?>
        <?=$form->field($model,'status')->textInput(); ?>
        <?=$form->field($model,'created_at')->textInput(); ?>
        <?=$form->field($model,'updated_at')->textInput(); ?>
        <?=$form->field($model,'created_by')->textInput(); ?>
        <?=$form->field($model,'updated_by')->textInput(); ?>
        
        <div class="form-group">
            <?= \yii\helpers\Html::submitButton('Save', [
                    'class' => 'btn btn-success'
                ]); 
            ?>
        </div>
    <?php \yii\widgets\ActiveForm::end(); ?>    
</div>