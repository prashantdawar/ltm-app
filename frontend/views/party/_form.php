<div class="party-form">
    <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <?= $form->field($model,'name')->textInput();?>
        <?= $form->field($model,'contact_name')->textInput();?>
        <?= $form->field($model,'phone')->textInput();?>
        <?= $form->field($model,'whatsapp')->textInput();?>
        <?= $form->field($model,'email')->textInput();?>
        <?= $form->field($model,'street_address')->textInput();?>
        <?= $form->field($model,'city')->textInput();?>
        <?= $form->field($model,'location')->textInput();?>
        <?= $form->field($model,'state')->textInput();?>
        <?= $form->field($model,'pincode')->textInput();?>
        <?= $form->field($model,'gst')->textInput();?>

        <div class="form-group">
            <?= \yii\helpers\Html::submitButton('Save',[
                'class' => 'btn btn-success'
            ]);?>
        </div>  
    <?php \yii\widgets\Activeform::end(); ?>

</div>