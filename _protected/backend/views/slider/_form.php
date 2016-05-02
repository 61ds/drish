<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;



/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
$pagearray = $model->getPageId();
$pieces = explode(",", $model->pageid);
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'galley_name')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'status')->dropDownList(['1' => 'Active','0' => 'UnActive']); ?>
	<?php
	foreach($pagearray as $pge){
		?>
		<input type="checkbox" name="pageid[]" id="pageid" style="display:none;" value="<?php echo $pge->id; ?>" 
		<?php  
		if(in_array($pge->id, $pieces)){
			echo " checked";

		}	
		?> >
		<label for="checkbox_id" style="display:none;"><?php echo $pge->name; ?></label>
		<br>

		<?php

	}
	?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php   ActiveForm::end(); ?>

</div>
<style>
.dele_img {
    width: 100%;
    border: 1px solid #000;
    font-weight: bold;
    cursor: pointer;
}
.file-updat {
    width: 100%;
    height: auto;
    overflow: hidden;
    border: 1px solid #8C8C8C;
    border-radius: 5px;
}
</style>
