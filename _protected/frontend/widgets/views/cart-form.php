<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$js = <<<JS
// get the form id and set the event
$('form#{$cart->formName()}').on('beforeSubmit', function(e) {
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
			if(response.type == 'success'){
				$(".flash span").html(response.message);
				$(".flash").fadeIn(100);
				setTimeout(function(){
				$(".flash").fadeOut();
				},3000);
				setTimeout(function(){
					$(".flash span").html("");
				},4000);

				$('.cart-count').html(response.count);
				$('form#{$cart->formName()}').trigger('reset');
				$('.form-success').html(response.message);
			}else{
				$.each( response, function( key, value ) {
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
$baseurl = Yii::$app->params['baseurl'];
?>

<?php $form = ActiveForm::begin([
	'action'=> $baseurl.'/cart/add',
	'id'     => $cart->formName(),
	'enableAjaxValidation'   => false,
]); ?>
<?= $form->field($cart, 'varient_id')->hiddenInput()->label(false) ?>
<?= $form->field($cart, 'product_id')->hiddenInput()->label(false) ?>
	<div class="quantity">
		<div class="select-size">
			<div class="color">

				<?= $form->field($cart, 'size')->dropDownList(
					$varientModel->getAvailattr($model->id,'size'),
					[
						'prompt'=>'Select Size',
						'class'=>'form-control select2 required updateprice',
					]
				)->label(false);
				?>
			</div>
			<div class="color">
				<?= $form->field($cart, 'width')->dropDownList(
					$varientModel->getAvailattr($model->id,'width'),
					[
						'prompt'=>'Select Width',
						'class'=>'form-control select2 required updateprice',
					]
				)->label(false);
				?>
			</div>
		</div>

		<div class="select-size">

			<div class="color">
				<?= $form->field($cart, 'color')->dropDownList(
					$varientModel->getAvailattr($model->id,'color'),
					[
						'prompt'=>'Select Color',
						'class'=>'form-control select2 required updateprice',
					]
				)->label(false);
				?>
			</div>
			<div class="color">
				<?= $form->field($cart, 'quantity')->dropDownList(
					$varientModel->getQuantity($model->id),
					[
						'class'=>'form-control select2 required',
					]
				)->label(false);
				?>
			</div>

		</div>

		<div class="select-size">
			<div class="color">
				<p>Size and Width guide <span class="foot-scale"> <img title="foot-scale" alt="foot-scale" src="<?= Yii::$app->params['baseurl'] ?>/images/foot-scale.png"></span></p>
			</div>

			<div class="color">
				<input type="text" placeholder="Enter Zip Code">
			</div>
		</div>
	</div>

	<div class="add-to-cart">
		<a>
			<?= Html::submitButton('<span><img title="cart-add" alt="cart-add" src="'.$baseurl.'/images/cart-add.png"></span> Add to Cart', ['class' => 'btn btn-default', 'name' => 'register-button']) ?>
		</a>

	</div>

	<div class="wish-list">
		<p><span class="wish-img"><img title="wish-list" alt="wish-list" src="<?= Yii::$app->params['baseurl'] ?>/images/add-wishlist.png"></span>Add to Wishlist</p>
		<p class="avail">Availability:<span class="green-color">In stock</span></p>

	</div>
<?php ActiveForm::end(); ?>