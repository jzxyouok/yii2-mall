<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html; 
?>
<div class="content">
        
        <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>选择推荐位</h3>
                </div>

                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <?php 
                            if(Yii::$app->session->hasFlash('info')){
                                echo Yii::$app->session->getFlash('info');
                            }
                        ?>
                        <?php $form = ActiveForm::begin([
                            'fieldConfig'=>['template'=>'{input}']
                        ]) ?>
                        <?php echo $form->field($product,'productid')->hiddenInput([
                        'template'=>'{input}' 
                        ]) ?>
                        <?php echo $form->field($product,'position')->dropDownList($position,['class'=>'span6']) ?>
                        <br>
                        <br>
                        <?php echo Html::submitButton('提交',['class'=>'span2']) ?>
                        <?php ActiveForm::end() ?>
                    </div>

                    <!-- side right column -->
                    <div class="span3 form-sidebar pull-right">
                       
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