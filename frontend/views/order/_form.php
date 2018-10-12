
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
        <?php /*
            echo $form->field($model, 'item_id')->label('Item Name')->widget(\kartik\select2\Select2::classname(), [
            'data' => $data['allItems'],
            'options' => ['placeholder' => 'Select an Item ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple'  => true
            ],
        ]); */?>



        <?php
            // $dataItems = [];
            // foreach($data['allItems'] as $key => $value){
            //     array_push($dataItems,$value); 
            // }
            
            foreach($modelsItem as $index => $modelItem){ ?>

            <?php 
                $modelName = strtolower($modelItem->formName());
                $modelIdAmount = json_encode([]);
                if(!empty($data['allItems']['id_amount'])){
                    $modelIdAmount = json_encode($data['allItems']['id_amount']);
                }
            ?>
            <div class="col-md-6" style="clear:left;">
                <?php   echo $form->field($modelItem, '['.$index.']'.'name')->widget(\kartik\select2\Select2::classname(), [
                    'data' => empty($data['allItems']['id_name']) ? []:$data['allItems']['id_name'],
                    'options' => ['placeholder' => 'Select an Item ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'pluginEvents' => [
                        'select2:opening' => "function() { 
                                                $('#$modelName-$index-amount').val('');
                                                $('#$modelName-$index-quantity').val(''); 
                                                $('#order-amount').val(function(){ 
                                                    var netamount = 0; 
                                                    $('.amount').each(
                                                        function(){
                                                            netamount += parseInt($(this).val()) || 0;                                                       
                                                        }
                                                    );
                                                    return netamount; 
                                                });
                                            }",
                        'select2:closing' => "function() {
                                                var modelIdAmount = $modelIdAmount; 
                                                $('#$modelName-$index-amount').val(modelIdAmount[$(this).val()]);
                                                $('#$modelName-$index-quantity').val('1').trigger('blur');
                                                $('#$modelName-$index-amount-hidden').val(modelIdAmount[$(this).val()]);
                                                $('#order-amount').val(function(){ 
                                                    var netamount = 0; 
                                                    $('.amount').each(
                                                        function(){
                                                            netamount += parseInt($(this).val()) || 0;                                                       
                                                        }
                                                    );
                                                    return netamount; 
                                                });
                                            }",
                        'select2:unselect' => "function() { 
                                                $('#$modelName-$index-amount').val('');
                                                $('#$modelName-$index-quantity').val('');  
                                                $('#order-amount').val(function(){ 
                                                    var netamount = 0; 
                                                    $('.amount').each(
                                                        function(){
                                                            netamount += parseInt($(this).val()) || 0;                                                       
                                                        }
                                                    );
                                                    return netamount; 
                                                });
                                            }",
                    ]
                ]); 
            ?>
            </div>
            <div class="col-md-2" style="">                
                
                <?= \yii\helpers\Html::hiddenInput('ah', ($modelItem->name) ? $data['allItems']['id_amount'][$modelItem->name] : null, ['id' => strtolower($modelItem->formName()).'-'.$index.'-amount-hidden']) ?>
                <?= $form->field($modelItem,'['.$index.']'.'quantity')
                        ->textInput(['type' => 'number', 'autocomplete' => 'off','onchange' => ' 
                                            // var modelIdAmount = '.$modelIdAmount.';
                                            // console.log(Array.isArray(modelIdAmount));
                                            // console.log($(this).parent().parent().find("input").val());
                                            // console.log($(this).val());
                                            // console.log((parseInt($(this).val()) || 0) * (parseInt(modelIdAmount[$(this).parent().parent().find("input").val()]) || 0));
                                            var grossAmount = (parseInt($(this).val()) || 0) * (parseInt($(this).parent().parent().find("input").val()) || 0);
                                            $("#'.$modelName.'-'.$index.'-amount").val(grossAmount);
                                            $("#order-amount").val(function(){ 
                                                var netamount = 0; 
                                                $(".amount").each(
                                                    function(){
                                                        netamount += parseInt($(this).val()) || 0;                                                       
                                                    }
                                                );
                                                return netamount; 
                                            });
                                            
                                    ']); 
                ?>
            </div>             
            <div class="col-md-3" style="">
                <div class="form-group">
                    <?= \yii\helpers\Html::label('Amount', 'amount', ['class' => 'control-label']) ?>
                    <?= \yii\helpers\Html::textInput(
                                            'amount', 
                                            ($modelItem->name) ? $data['allItems']['id_amount'][$modelItem->name] * $modelItem->quantity : null,
                                            [
                                                'id' => strtolower($modelItem->formName()).'-'.$index.'-amount',
                                                'class' => 'form-control amount', 'disabled' => true
                                            ]); ?>
                    <?php //= $form->field($modelItem,'['.$index.']'.'quantity')->textInput(); ?>
                </div>
            </div>
            <!-- <div class="col-md-2" style="">
                                <div class="form-group field-orderitem-0-quantity required">
                <label class="control-label" for="orderitem-0-quantity">Quantity</label>
                <input id="orderitem-0-quantity" class="form-control" name="OrderItem[0][quantity]" type="text">

                <div class="help-block"></div>
                </div>            </div> -->
            <br>
        <?php } ?>
       
        <?=$form->field($model,'amount')->textInput(['type' => 'number', 'autocomplete' => 'off']); ?>

        <?php if(!$model->payment_mode) $model->payment_mode = 0; // see order model $paymentMode[]?>
        <?= $form->field($model,'payment_mode')->widget(\kartik\select2\Select2::classname(), [
                'hideSearch' => true,
                'data' =>$model->paymentMode,
                'options' => ['placeholder' => 'Select Payment Mode'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); 
        ?>
        <?php if(!$model->status) $model->status = 0; // set default to completed for kartik-v select2 widget // see order model $orderStatus[] for value?>
        <?= $form->field($model,'status')->widget(\kartik\select2\Select2::classname(), [
                'hideSearch' => true,
                'data' =>$model->orderStatus,
                'options' => ['placeholder' => 'Select order status'],
                'pluginOptions' => [
                    'allowClear' => true,                    
                ],
            ]); 
        ?>
        
        <?= $form->field($model, 'notes')->textarea(); ?>
        
        <div class="form-group">
            <?= \yii\helpers\Html::submitButton('Save', [
                    'class' => 'btn btn-success'
                ]); 
            ?>
        </div>
    <?php \yii\widgets\ActiveForm::end(); ?>    
</div>