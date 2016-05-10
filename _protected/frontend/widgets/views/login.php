<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$js = <<<JS
// get the form id and set the event
$('form#{$model->formName()}').on('beforeSubmit', function(e) {
	var form = $(this);
	if (form.find('.has-error').length) {
	  return false;
	}
	// submit form
	$.ajax({
		url: form.attr('action'),
		type: 'post',
		data: form.serialize(),
		success: function (response) {						
			if(response.type == 'error'){		
				response=JSON.parse(response.error);
				$.each( response, function( key, value ) {
					console.log(value);
					$('#'+key).parent().removeClass('has-success').addClass('has-error');
					$('#'+key).parent().find('.help-block').html(value);
				});												
			}					
		}
	});
	return false;
}).on('submit', function(e){
    e.preventDefault();
});
JS;
 
$this->registerJs($js);
?>		<div class="row" id="logindiv">			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">				<div class="new-cust">					 <h4>NEW CUSTOMERS</h4>					 <div class="sign-up">						 <p>By creating an account with our store, you will be able to move through the checkout 							process faster, store multiple shipping addresses, view and track your orders in your 							account and more.</p>						<button type="button" class="create" id="login_btn">Create an account</button>   					</div>				</div>			</div>						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">				<div class="new-cust">					<h4>REGISTERED CUSTOMERS</h4>					<div class="sign-up">						<p>If you have an account with us, please log in.</p>						<?php $form = ActiveForm::begin([						'id' => $model->formName(),						'action' => ['site/login'],								'enableAjaxValidation'   => false,							]); ?>							<div class="email-field">								 <?= $form->field($model, 'username',[								'inputOptions' => [									'placeholder' => 'Username/Email',								]])->label(false) ?> 								<?= $form->field($model, 'password',[								'inputOptions' => [									'placeholder' => 'Password',								]])->passwordInput()->label(false) ?>										 								<div class="forgot-pwd">									<?= Html::submitButton('Login', ['class' => 'btn btn-default login', 'name' => 'login-button']) ?>   <span class="for-pwd red-color">Forgot Your Password?</span>								</div>												</div>						<?php ActiveForm::end(); ?>					</div>				</div>			</div>		</div>	



