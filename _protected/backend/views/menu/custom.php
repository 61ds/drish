
<?php

	$this->registerJs(
		'$("#menu-selectdata").empty();
		$(".field-menu-selectdata").hide();'
	);

	echo $form->field($node, 'menu_type')->dropDownList(
	$node->menuTypes,
	['prompt'=>'Select Menu Type',
	'onchange'=>'
		
		$("#menu-link").val("");
		if($(this).val() != 2 && $(this).val() != ""){
			$.post( "'.Yii::$app->urlManager->createUrl('menu/values?id=').'"+$(this).val(), function( data ) {
				if(data.result){
					$( "select#menu-selectdata" ).html( data.result );
					$(".field-menu-selectdata").show();
				}
		   });
		}else{
			$("#menu-link").attr("readonly", false);

			$("#menu-link").val("");
			$("#menu-selectdata").empty();
			$(".field-menu-selectdata").hide();
			$(".field-menu-link").show();


		}
	',
	'class'=>'form-control select2']
	);

?>

<?= $form->field($node, 'selectdata')->dropDownList(array(),
	['prompt'=>'Select Data',
	'onchange'=>'
		pid = $("#menu-type").val();
		if(pid != ""){
			url = "";
			if(pid == 1){ url = ""; }

			link = $(this).val();
			name = $("#menu-selectdata option:selected").text();
			$("#menu-link").val(url+""+link+".html");
			$("#menu-name").val(name);
			$(".field-menu-link").hide();
		}else{
			$("#menu-name").val("");
			$("#menu-link").val("");


		}
	',
	'class'=>'form-control select2'])->label('Select option'); ?>
	
	<?= $form->field($node, 'status')->dropDownList(['1' => 'Active','0' => 'Inactive']); ?>	
	
	<?php
		if($node->menu_type == 1){
			echo $form->field($node, 'link')->textInput(['maxlength' => true,'readonly'=>true]); 
					
		}else{ 
			echo $form->field($node, 'link')->textInput(['maxlength' => true]); 
		}
	?>
					
							