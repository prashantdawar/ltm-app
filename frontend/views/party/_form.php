<div class="party-form">
    <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <?= $form->field($model,'name')->textInput();?>
        <?= $form->field($model,'contact_name')->textInput();?>
        <?= $form->field($model,'phone')->textInput();?>
        <?= $form->field($model,'email')->textInput();?>
        <?= $form->field($model,'street_address')->textInput();?>
        <?= $form->field($model,'city')->textInput();?>
        <?= $form->field($model,'location')->textInput();?>
        <?= $form->field($model,'state')->textInput();?>
        <?= $form->field($model,'pincode')->hiddenInput(['value'=> 10])->label(false);?>
        <?= $form->field($model,'last_order_id')->hiddenInput(['value'=> 10])->label(false);?>
        <?= $form->field($model,'gst')->textInput()->label('GSTIN Number');?>
        <?= $form->field($model,'pan')->hiddenInput(['value'=> 10])->label(false);?>
        <?= $form->field($model,'status')->hiddenInput(['value'=> 10])->label(false);?>
        <?= $form->field($model,'created_at')->hiddenInput(['value'=> 10])->label(false);?>
        <?= $form->field($model,'updated_at')->hiddenInput(['value'=> 10])->label(false);?>

        <div class="form-group">
            <?= \yii\helpers\Html::submitButton('Save',[
                'class' => 'btn btn-success'
            ]);?>
        </div>  
    <?php \yii\widgets\Activeform::end(); ?>

</div>