<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html; 
?>
<div class="content">
        
        <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>添加商品</h3>
                </div>

                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <?php 
                            if(Yii::$app->session->hasFlash('info')){
                                echo Yii::$app->session->getFlash('info');
                            }
                        ?>
                        <div class="container">
                         <?php $form = ActiveForm::begin([
                                'options'=>['class'=>'new_user_form inline-input',],
                                'fieldConfig'=>['template'=>'{error}<div class="span12 field-box">{label}{input}</div>'],
                        ]) ?>
                            <?php echo $form->field($model,'parentid')->dropDownList($list,['class'=>'span6','optgroup'=>false]) ?>
                            <?php echo $form->field($model,'title')->textInput(['class'=>'span9']) ?>
                                <div class="span11 field-box actions">
                                <?php echo Html::submitButton(' 新增 ',['class'=>'btn-glow primary']) ?>
                                    <span>OR</span>
                                    <input type="reset" value="Cancel" class="reset" />
                                </div>
                           <?php ActiveForm::end()?> 
                        </div>
                    </div>

                    <!-- side right column -->
                    <div class="span3 form-sidebar pull-right">
                        <div class="btn-group toggle-inputs hidden-tablet">
                            <button class="glow left active" data-input="inline">INLINE INPUTS</button>
                            <button class="glow right" data-input="normal">NORMAL INPUTS</button>
                        </div>
                        <div class="alert alert-info hidden-tablet">
                            <i class="icon-lightbulb pull-left"></i>
                            Click above to see difference between inline and normal inputs on a form
                        </div>                        
                        <h6>Sidebar text for instructions</h6>
                        <p>Add multiple users at once</p>
                        <p>Choose one of the following file types:</p>
                        <ul>
                            <li><a href="#">Upload a vCard file</a></li>
                            <li><a href="#">Import from a CSV file</a></li>
                            <li><a href="#">Import from an Excel file</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>