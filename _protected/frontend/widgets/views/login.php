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
?>


