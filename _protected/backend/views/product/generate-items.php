<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Generate Items';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'colors')->dropDownList(
        $model->getAvailcolor($model->product_id),
        [
            'class'=>'form-control select2 required',
            'multiple' => 'multiple'

        ]
    );
    ?>
    <div class="help-block" style="display:none; color:red;">Please Select atleast One.</div>

    <div class="form-group">
        <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
