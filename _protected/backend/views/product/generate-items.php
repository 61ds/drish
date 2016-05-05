<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Generate Items for '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'colors')->dropDownList(
        $model->allcolor,
        [
            'prompt'=>'- Select color -',
            'class'=>'form-control select2'

        ]
    );
    ?>


    <div class="form-group">
        <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
