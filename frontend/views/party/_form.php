<div class="party-form">
    <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <?= $form->field($model,'name')->textInput(['autocomplete' => 'off']);?>
        <?= $form->field($model,'contact_name')->textInput(['autocomplete' => 'off']);?>
        <?= $form->field($model,'phone')->textInput(['autocomplete' => 'off']);?>
        <?= $form->field($model,'whatsapp')->textInput(['autocomplete' => 'off']);?>
        <?= $form->field($model,'email')->textInput(['autocomplete' => 'off']);?>
        <?= $form->field($model,'street_address')->textInput();?>
        <?= $form->field($model,'city')->textInput();?>
        <?= $form->field($model,'location')->textInput();?>
        <?= $form->field($model,'state')->textInput();?>
        <?= $form->field($model,'pincode')->textInput();?>
        <?= $form->field($model,'gst')->textInput(['autocomplete' => 'off']);?>

        <div class="form-group">
            <?= \yii\helpers\Html::submitButton('Save',[
                'class' => 'btn btn-success'
            ]);?>
        </div>  
    <?php \yii\widgets\Activeform::end(); ?>

</div>