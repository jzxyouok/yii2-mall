 <?php 
 use yii\bootstrap\ActiveForm;
 use yii\helpers\Html;
 ?>
 <div class="content">
        
        <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>change password</h3>
                </div>

                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <div class="container">
                            <?php
                                if(Yii::$app->session->hasFlash('info')){
                                    echo Yii::$app->session->getFlash('info');
                                }
                             ?>
                            <?php $form = ActiveForm::begin([
                                'options'=>['class'=>'ew_user_form inline-input'],
                                'fieldConfig'=>[
                                    'template' => "<div class='span12 field-box'>{label}{input}</div><div >{error}</div>"
                                ]
                            ]) ?>
                            
                            <?php echo $form->field($model,'adminuser')->textInput(['class'=>'span9','disabled'=>true]); ?>
                            <?php echo $form->field($model,'adminpass')->passwordInput(['class'=>'span9']); ?>
                            <?php echo $form->field($model,'repass')->textInput(['class'=>'span9']); ?>
                            
                               <div class="span11 field-box actions">
                                <?php echo Html::submitButton('Save',['class'=>'btn-glow primary','value'=>'Create user']) ?>
                                    <!-- <input type="button" class="btn-glow primary" value="Create user" /> -->
                                    <span>OR</span>
                                    <input type="reset" value="Cancel" class="reset" /> 
                                </div>
                            <?php ActiveForm::end() ?>
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