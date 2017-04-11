<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<main id="authentication" class="inner-bottom-md">
	<div class="container">
		<div class="row">
			
			<div class="col-md-10">
				<section class="section sign-in inner-right-xs">
					<h2 class="bordered">完善您的信息
					<img src="<?php echo Yii::$app->session['userInfo']['figureurl_1'] ?>">
					</h2>
					<p>Hello, Welcome to your account</p>

					<?php 
						if(Yii::$app->session->hasFlash('info')){
							echo Yii::$app->session->getFlash('info');
						}
						$form = ActiveForm::begin([
								'options' => ['class'=>'login-form cf-style-1'],
							])
					?>
						<div class="field-row">
							<input class="le-input" type="text" name="nickname" disabled="disabled" value="<?php echo Yii::$app->session['userInfo']['nickname'] ?>">
						</div>
						<div class="field-row">
                            <?php echo $form->field($model,'username')->textInput(['class'=>'le-input']) ?>
                        </div><!-- /.field-row -->

                        <div class="field-row">
                            <?php echo $form->field($model,'userpass')->passwordInput(['class'=>'le-input']) ?>
                        </div><!-- /.field-row -->

						 <div class="field-row">
                            <?php echo $form->field($model,'repass')->passwordInput(['class'=>'le-input']) ?>
                        </div><!-- /.field-row -->
                        <div class="field-row clearfix">
                        	<span class="pull-right">
                        		<a href="<?php echo yii\helpers\Url::to(['member/seekpass']) ?>" class="content-color bold">Forgotten Password ?</a>
                        	</span>
                        </div>

                        <div class="buttons-holder">
                        <?php echo Html::submitButton('注册',['class'=>'le-button huge']) ?>
                        </div><!-- /.buttons-holder -->
					<?php ActiveForm::end() ?>
				</section><!-- /.sign-in -->
			</div><!-- /.col -->

		</div><!-- /.row -->
	</div><!-- /.container -->
</main><!-- /.authentication -->
<script type="text/javascript">
	var qq = document.getElementById('qq-login');
	qq.onclick = function(){
		window.location.href = "<?php echo yii\helpers\Url::to(['member/qqlogin']) ?>";
	}
</script>
