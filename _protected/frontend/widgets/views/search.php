<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->registerJs("
function wordsdesc(){	
	var val = $('#searchform-search').val();	
		$.ajax({
		url: 'site/search',
		type: 'post',
		dataType: 'json',
		data: { searchevent : val},
		success: function (response) {	
			$('#search_li').empty();
			if(response != '' && response != null){
				$.each( response, function( key, value ) {
					link = value.link;
					$('#search_li').append('<li><a href='+link+' >'+value.name+'</a></li>');
				});
			}else{
				$('#search_li').append('<li><a href=# >No Items Found !</a></li>');
			}
					
		}
	});
}
$('#searchform-search').keyup(function () {
	var len = $('#searchform-search').val().length;
	if(len >= 3){
		wordsdesc();
	}	
	});"
);

?>

<?php $form = ActiveForm::begin([
	'action'=>['site/product-search'],
	'id'     => "SearchForm",
	'enableAjaxValidation'   => false,
]); ?>
 <?php if($type == "second"){ ?>
		<div class="search-right mob-serach">
			<?= $form->field($model, 'search')->textInput(['maxlength' => true,"placeholder" => "Search...",'class'=>"search-txt"])->label(false) ?>
		</div>
        <span class="f-mob-search"><i class="fa fa-search"></i></span>
 <?php }else{ ?>
		 <div class="input-group search-bar-home">
		 <?= $form->field($model, 'search')->textInput(['maxlength' => true,"placeholder" => "Search products",'class'=>"form-control"])->label(false) ?>
            <div class="input-group-btn search-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
		<div class="search-result">
		<ul id="search_li">
		</ul>
		</div>
<?php } ?>
 <?php ActiveForm::end(); ?>
