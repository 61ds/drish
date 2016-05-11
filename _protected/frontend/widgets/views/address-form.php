<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$baseurl = Yii::$app->params['baseurl'];

$js = <<<JS

// get the form id and set the event

$('form#{$billingModel->formName()}').on('beforeSubmit', function(e) {

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
?>
    <?php $form = ActiveForm::begin([
        'action'=> $baseurl.'/cart/add',
        'id'     => $billingModel->formName(),
        'enableAjaxValidation'   => false,
        'options' => [
            'class' => 'form-fill'
        ],
    ]); ?>
    <div class="user-form">
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">First Name*</label>
                <?= $form->field($billingModel, 'fname',[
                    'inputOptions' => [
                        'class'=>'form-control',
                    ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Last Name*</label>
                <?= $form->field($billingModel, 'lname',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <!-- end of first& last name-->
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Street address 1*</label>
                <?= $form->field($billingModel, 'address',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Street address 2</label>
                <?= $form->field($billingModel, 'address',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <!-- end of agrress street-->


        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Phone*</label>
                <?= $form->field($billingModel, 'phone',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Email Address*</label>
                <?= $form->field($billingModel, 'email',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <!-- end of agrress street-->
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Confirm Email*</label>
                <?= $form->field($billingModel, 'email',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <!-- end of email and phone-->
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Company</label>
                <?= $form->field($billingModel, 'company',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>

        <!-- end of company-->
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">City*</label>
                <?= $form->field($billingModel, 'city_id',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Province/Territory</label>
                <?= $form->field($billingModel, 'state_id',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>

        <!-- end of city-->
        <div class="input-first-half">
            <fieldset class="form-group">
                <label for="firstname">Postal Code</label>
                <?= $form->field($billingModel, 'zip',[
                        'inputOptions' => [
                            'class'=>'form-control',
                        ]]
                )->label(false);
                ?>
            </fieldset>
        </div>
        <div class="input-first-half">
            <fieldset class="form-group country">
                <label for="countrySelect1">Country*</label>
                <select class="form-control dropfieldtxt" id="exampleSelect1">
                    <option>India</option>
                    <option>Chandigargh</option>
                    <option>Goa</option>
                    <option>Rajasthan</option>
                    <option>Punjab</option>
                </select>
            </fieldset>
        </div>
        <!-- end of country select-->
    </div>

    <!-- end of form fill-first half-->

        <h5>Shipping  Address</h5>
        <div class="checkbox enter-pwd chek-label">
            <label>
                <input type="checkbox" id="shipaddbtn"> <div class="text-enter ship-chk">Ship to a Different Address</div>
            </label>
            <label>
                <input type="checkbox"> <div class="text-enter ship-chk">Enter a password to create an account</div>
            </label>
        </div>



        <div class="user-form" id="shipping-address-form">
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">First Name*</label>
                    <?= $form->field($shippingModel, 'fname',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Last Name*</label>
                    <?= $form->field($shippingModel, 'lname',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <!-- end of first& last name-->
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Street address 1*</label>
                    <?= $form->field($shippingModel, 'address',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Street address 2</label>
                    <?= $form->field($shippingModel, 'address',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <!-- end of agrress street-->


            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Phone*</label>
                    <?= $form->field($shippingModel, 'phone',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Email Address*</label>
                    <?= $form->field($shippingModel, 'email',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <!-- end of agrress street-->
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Confirm Email*</label>
                    <?= $form->field($billingModel, 'email',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <!-- end of email and phone-->
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Company</label>
                    <?= $form->field($shippingModel, 'company',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>

            <!-- end of company-->
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">City*</label>
                    <?= $form->field($shippingModel, 'city_id',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Province/Territory</label>
                    <?= $form->field($shippingModel, 'state_id',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>

            <!-- end of city-->
            <div class="input-first-half">
                <fieldset class="form-group">
                    <label for="firstname">Postal Code</label>
                    <?= $form->field($shippingModel, 'zip',[
                            'inputOptions' => [
                                'class'=>'form-control',
                            ]]
                    )->label(false);
                    ?>
                </fieldset>
            </div>
            <div class="input-first-half">
                <fieldset class="form-group country">
                    <label for="countrySelect1">Country*</label>
                    <select class="form-control dropfieldtxt" id="exampleSelect1">
                        <option>India</option>
                        <option>Chandigargh</option>
                        <option>Goa</option>
                        <option>Rajasthan</option>
                        <option>Punjab</option>
                    </select>
                </fieldset>
            </div>
            <!-- end of country select-->
        </div>


<hr>
<div class="red-btn"> <?= Html::submitButton('CONTINUE') ?></div>
<?php ActiveForm::end(); ?>