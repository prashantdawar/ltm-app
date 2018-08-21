
<div class="order-form">
    <?php $form = \yii\widgets\ActiveForm::begin(); ?>

        <?php
            echo $form->field($model, 'party_id')->label('Party Name')->widget(\kartik\select2\Select2::classname(), [
            'data' => $data['allParties'],
            'options' => ['placeholder' => 'Select a party ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        <?php
            echo $form->field($model, 'item_id')->label('Item Name')->widget(\kartik\select2\Select2::classname(), [
            'data' => $data['allItems'],
            'options' => ['placeholder' => 'Select an Item ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        
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