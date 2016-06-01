<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->registerJs("
	$('.editable').hide();
	$('.edit_admin_display').click(function() {
		target = $(this).attr('target-class');
		type = $(this).attr('attr-type');
		if(type == 'edit'){
			$(this).text('save');
			$(this).attr('attr-type','save');
			$('.'+target).find('.readable').hide();			
			$('.'+target).find('.editable').show();
		}else{
			id = $( '.'+target+' form').attr('id');
			response = $('#'+id).yiiActiveForm('submitForm');
			return false;
		}
	});
");
?>	<div class="acount-arrow">		<img title="edit" alt="edit" src="<?= Yii::$app->params['baseurl'] ?>/uploads/account-arrow.png">	</div>
			<div class="row">
			<div class="account-create">
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
					<h3>Account Information</h3>
				</div>

			</div>
		</div>
		<?php $form = ActiveForm::begin([
			'id' => 'account-information',
			'action' => ['account/information'],
			'enableAjaxValidation'   => true,
			'options' => ['onsubmit'=>'return false;']
			]) 
		?>			
			<div class="row readable">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="input-field">
						<label> First Name :</label>
						<div class="first-name">		
							<?= $profile->fname ?> 
						</div>
					</div>					<div class="input-field">						<label> Last Name :</label>						<div class="first-name">									<?= $profile->lname ?>						</div>					</div>
						


					<div class="input-field">
						<label>Phone no :</label>
						<div class="first-name">		
							<?= $profile->phone ?>
						</div>
					</div>
				</div>	
			</div>
			<div class="row editable">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="input-field">
						<label> First Name :</label>
						<div class="first-name">		
						

								<?= $form->field($profile, 'fname',[
									'template' => '<div class="input-group">{label}{input}{error}{hint}</div>'
								])->label(false) ?> 									
								
			
						</div>
					</div>					<div class="input-field">						<label> Last Name :</label>						<div class="first-name">																<?= $form->field($profile, 'lname',[									'template' => '<div class="input-group">{label}{input}{error}{hint}</div>'								])->label(false) ?> 																										</div>					</div>
						


					<div class="input-field">
						<label>Phone no :</label>
						<div class="first-name">		

								<?= $form->field($profile, 'phone',[
									'template' => '<div class="input-group">{label}{input}{error}{hint}</div>'
								])->label(false) ?> 	
						</div>
					</div>
				</div>	
			</div>
		
		<?php ActiveForm::end(); ?>	
	
			
			<div class="row">
				<div class="col-lg-12">
				<button type="button" target-class="account-information" attr-type="edit"class="btn btn-default edit_admin_display">Edit</button>
				</div>
			</div>