<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;
use kartik\slider\Slider;
use kartik\file\FileInput;

$this->title = 'Add new product';

$main_image = \Yii::$app->request->baseUrl . '/uploads/no-image.png';
?>

<div class="basic-info">

    <div class="admin-display-header">
        <h4>Step 1: Add Product Info</h4>
    </div>
    <div class="admin-display-box">
        <div class="admin-form sm-input">
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Basic Info</a></li>
        <li><a href="#tab_3" data-toggle="tab">Images Info</a></li>
        <li><a href="#tab_4" data-toggle="tab">Meta Info</a></li>
        <li><a href="#tab_5" data-toggle="tab">Related Products</a></li>
        <li><a href="#tab_6" data-toggle="tab">Special Product</a></li>
    </ul>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <input type="hidden" name="step" value="pbi">

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'quantity')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'article_id')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'sku')->textInput() ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
            <?= $form->field($model, 'price')->textInput() ?>

            <?= $form->field($model, 'market_price')->textInput() ?>
            </div>
                    <div class="col-md-6">
                        <?php
                        $count = round(count($general_attrs)/2);
                        $i = 0;
                        foreach($general_attrs as $attr){
                            if($count == $i){
                                echo "</div><div class='col-md-6'>";
                            }
                            $attr_name = 'general_attrs['.$attr->id.']';

                            echo $form->field($model, $attr_name)->dropDownList(
                                $dropdownmodel->getAttrValues($attr->id),
                                [
                                    'prompt'=>'- Select option -',
                                    'class'=>'form-control select2',
                                ]
                            )->label($attr->name);
                            $i++;
                        }
                        ?>
                    </div>
                    <div class="col-md-12">
                    <?= $form->field($model, 'short_descr')->textarea(['rows' => 4]) ?>

            <?= $form->field($model, 'descr')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'full',
                'clientOptions' => [
                    'filebrowserBrowseUrl' => Url::to(['uploadfile/browse']),
                    'filebrowserUploadUrl' => Url::to(['uploadfile/url'])
                ]
            ]) ?>

            </div>
        </div>
    </div>
        </div>

        <div class="tab-pane" id="tab_3">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box1">
                        <h4 class="head4-borderd">Please upload main image here:</h4>
                        <?= $form->field($ProductImagesModel, 'main_image')->widget(FileInput::classname(),
                            [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'showCaption' => false,
                                    'showRemove' => true,
                                    'showUpload' => false,
                                    'initialPreview'=>[
                                        Html::img($main_image, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
                                    ],
                                ]
                            ]);
                        ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="img-box1">
                        <h4 class="head4-borderd">Please upload Flip image here:</h4>
                        <?= $form->field($ProductImagesModel, 'flip_image')->widget(FileInput::classname(),
                            [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'showCaption' => false,
                                    'showRemove' => true,
                                    'showUpload' => false,
                                    'initialPreview'=>[
                                        Html::img($main_image, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
                                    ],
                                ]
                            ]);
                        ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <h4 class="head4-borderd">Please upload here all other images:</h4>
                    <?php
                    // Usage with ActiveForm and model
                    echo $form->field($ProductImagesModel, 'other_image[]')->widget(FileInput::classname(),
                        [
                            'options' => ['accept' => 'image/*','multiple' => true],
                            'pluginOptions' => [
                                'showCaption' => false,
                                'showRemove' => true,
                                'showUpload' => false,
                                'initialPreview'=>[
                                    Html::img($main_image, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
                                ],
                            ]
                        ]);
                    ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_4">

            <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'meta_description')->textarea(['rows' => 3]) ?>

            <?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="tab-pane" id="tab_5">

        </div>
        <div class="tab-pane" id="tab_6">

        </div>
    </div>
            </div>
        </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>