<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Discount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discount-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'coupon_type')->dropDownList(
         array('0'=>'specific','1'=>'generate'),
        [
            'prompt'=>'- Select coupon type -',
            'class'=>'form-control select2'

        ]
    )
    ?>

    <?= $form->field($model, 'coupon_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount_choice')->dropDownList(
        array('0'=>'Normal','1'=>'Buy one get second product discount','2'=>'minimum amount','3'=>'buy 1 get special product discount'),
        [
            'prompt'=>'- Select discount type -',
            'class'=>'form-control select2'

        ]
    )
    ?>

    <?= $form->field($model, 'discount_type')->dropDownList(
        array('0'=>'fixed','1'=>'percent'),
        [
            'prompt'=>'- Select discount type -',
            'class'=>'form-control select2'

        ]
    )
    ?>

    <?= $form->field($model, 'discount_amount')->textInput() ?>

    <?= $form->field($model, 'minimum_amount')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'uses_per_coupon')->textInput() ?>

    <?= $form->field($model, 'uses_per_customer')->textInput() ?>

    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::classname(), [
     //'language' => 'ru', //'dateFormat' => 'yyyy-MM-dd',
      ]) ?>



    <?= $form->field($model, 'end_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
