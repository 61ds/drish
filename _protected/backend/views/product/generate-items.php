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
        $model->allcolor,
        [
            'prompt'=>'- Select color -',
            'class'=>'form-control select2',
            'multiple' => 'multiple'

        ]
    );
    ?>


    <div class="form-group">
        <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
