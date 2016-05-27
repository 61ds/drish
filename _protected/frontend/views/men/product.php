<?php
use frontend\widgets\RelatedProducts;
use frontend\widgets\SpecialProducts;
use frontend\widgets\Reviews;
use frontend\widgets\CartForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

//echo"<prE>";print_r($model);die;
$this->registerJs("var product_price = ".json_encode($model->price)."; var varients = ".json_encode($varients).";", View::POS_END);

?>

<section class="product-area-outer">
    <div class="gry-bg">
        <div class="container-fluid cate-pad">

            <div class="row">
                <div class="col-ld-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="bredcrumb-nav">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="#">Adults</a></li>
                                    <li class="active"><a href="#">Men's Shoes</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 slider-bg">

                            <div id="example3" class="slider-pro">
                                <div class="sp-slides">
                                   <?php foreach($productImages as $otherimages){
                                       $images = unserialize($otherimages->other_image);
                                       foreach($images as $image){
                                           $urllarge = Yii::$app->params['baseurl'].'/uploads/product/other/'.$model->id.'/main/'.$image;
                                           $urlmed = Yii::$app->params['baseurl'].'/uploads/product/other/'.$model->id.'/large/'.$image;
                                           echo '<div class="sp-slide">';?>
                                           <img class="sp-image center-block" src="<?= $urlmed ?>
                                                data-src="<?= $urlmed ?>"
                                                data-small="<?= $urlmed ?>"
                                                data-medium="<?= $urlmed?>"
                                                data-large="<?=  $urllarge ?>"
                                                data-retina="<?=  $urllarge ?>"/>

                                           <?php echo"</div>";
                                       }

                                    } ?>
                                </div>

                                <div class="sp-thumbnails pro-thumb">
                                    <?php foreach($productImages as $otherimages){
                                        $images = unserialize($otherimages->other_image);
                                        foreach($images as $image){
                                            $urlthumb = Yii::$app->params['baseurl'].'/uploads/product/other/'.$model->id.'/thumbs/'.$image;
                                            ?>
                                            <img class="sp-thumbnail img-video" src="<?= $urlthumb ?>" >
                                            <?php
                                        }

                                    } ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end of slider thumbnail-->

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 bown-bg">
                    <div class="supper-soft">
                        <h3><?= $model->name ?></h3>
                        <h4 class="red-color"><i class="fa fa-inr"></i><?= $model->price ?></h4>
                        <div class="border-gry">
                            <?= html_entity_decode($model->descr) ?>
                        </div>

                        <div class="rating-area">
                            <div class="rating"> <span>Rating :</span>
                                <ul>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>

                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>



                            </div>

                            <?= CartForm::widget(['model'=>$model,'varientModel'=>$varientModel,'cart'=>$cart]) ?>
                            <div class="share-with">

                                <p> Share with:</p>
                                <div class="foot-socials">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                        <li><a href="#" ><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div><!--end foot-social-->
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <div class="container-fluid cate-pad">
        <div class="prdoct-area">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="review-nav nav nav-tabs">
                        <ul>
                            <li class="active"><a href="#home" data-toggle="tab" aria-expanded="false">Product Details </a></li>
                            <li><a href="#menu1" data-toggle="tab" aria-expanded="true">Reviews (0)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="home">
                            <div class="p-detail">
                            <?php
                            foreach($productDescValues as $descvalue){

                                echo'<p>'.$descvalue->attr->display_name.':</p><p>'.strip_tags($descvalue->value,"<b>").'</p>';
                            }
                            foreach($productTextValues as $textvalue){
                                echo'<p>'.$textvalue->attr->display_name.':</p><p>'.strip_tags($textvalue->value,"<b>").'</p>';
                            }
                            foreach($productDropdownValues as $dropvalue){
                                $getvalue = $dropdownValues->findOne($dropvalue->value_id);
                                echo'<p>'.$getvalue->attr->display_name.':</p><p>'.strip_tags($getvalue->name,"<b>").'</p>';
                            }
                            ?>


                                </div>
                        </div>

                        <div class="tab-pane fade" id="menu1">
						<?php  if (!Yii::$app->user->isGuest) { ?>
						   <?= Reviews::widget(['product_id' => $model->id]) ?>
						<?php } else{
							echo'<h3>Please Login For Write Review !</h3>';
						} ?>
						  </div>

                    </div>
                </div>
                <!-- end of review-->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="complete-look">
                        <h4>Complete Your Look</h4>
                         <?= SpecialProducts::widget(['product_id' => $model->id]) ?>
                    </div>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <hr class="border-line">
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= RelatedProducts::widget(['product_id' => $model->id]) ?>
              
            </div>


        </div>

    </div>
</section>  