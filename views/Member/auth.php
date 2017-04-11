<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<main id="authentication" class="inner-bottom-md">
	<div class="container">
		<div class="row">
			
			<div class="col-md-6">
				<section class="section sign-in inner-right-xs">
					<h2 class="bordered">Sign In</h2>
					<p>Hello, Welcome to your account</p>

					<div class="social-auth-buttons">
						<div class="row">
							<div class="col-md-6">
								<button id="qq-login" class="btn-block btn-lg btn btn-facebook"><i class="fa fa-qq"></i> Sign In with qq</button>
							</div>
							<div class="col-md-6">
								<button class="btn-block btn-lg btn btn-twitter"><i class="fa fa-weixin"></i> Sign In with wechat</button>
							</div>
						</div>
					</div>
					<?php 
						if(Yii::$app->session->hasFlash('info')){
                                echo Yii::$app->session->getFlash('info');
                            }
						$form = ActiveForm::begin([
								'options' => ['class'=>'login-form cf-style-1'],
								'action' =>['member/auth']
							])
					?>
						<div class="field-row">
                            <?php echo $form->field($model,'user')->textInput(['class'=>'le-input']) ?>
                        </div><!-- /.field-row -->

                        <div class="field-row">
                            <?php echo $form->field($model,'userpass')->passwordInput(['class'=>'le-input']) ?>
                        </div><!-- /.field-row -->

                        <div class="field-row clearfix">
                        	<span class="pull-left">
								<?php echo $form->field($model,'rememberMe')->checkbox([
									'class'=>'le-checbox auto-width inline',
									'template'=>'<label class="content-color">{input}<span class="bold">Remember me</span>'
								]) ?>
                        	</span>
                        	<span class="pull-right">
                        		<a href="<?php echo yii\helpers\Url::to(['member/seekpass']) ?>" class="content-color bold">Forgotten Password ?</a>
                        	</span>
                        </div>

                        <div class="buttons-holder">
                        <?php echo Html::submitButton('登录',['class'=>'le-button huge']) ?>
                        </div><!-- /.buttons-holder -->
					<?php ActiveForm::end() ?>
				</section><!-- /.sign-in -->
			</div><!-- /.col -->

			<div class="col-md-6">
				<section class="section register inner-left-xs">
					<h2 class="bordered">Create New Account</h2>
					<?php 
						if(Yii::$app->session->hasFlash('reg')){
                                echo Yii::$app->session->getFlash('reg');
                            }
						$form = ActiveForm::begin([
							'options'=>['class'=>'register-form cf-style-1'],
							'action'=>['member/reg']
							])
					?>
						<div class="field-row">
                            <?php echo $form->field($model,'useremail')->textInput([ 'class'=>'le-input' ,
                            	'template'=>'{input}'
                            ]) ?>
                        </div><!-- /.field-row -->

                        <div class="buttons-holder">
                        	<?php echo Html::submitButton('注册',['class'=>'le-button huge']) ?>
                        </div><!-- /.buttons-holder -->
					<?php ActiveForm::end() ?>


				</section><!-- /.register -->

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
