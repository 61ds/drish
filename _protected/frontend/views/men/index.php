<?php
use frontend\widgets\ProductsSlider;
use frontend\widgets\ProductsFeatured;
use frontend\widgets\OfferSlider;
?>
<div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12 col-padding">
                     <div class="full-slide">
                        <?= ProductsSlider::widget(['type'=>"men"]); ?>
                     </div>
                  </div>
                  <!--end col-lg-12-->
               </div>
               <!--end row--->
               <div class="row">
                  <div class="col-lg-12 bag col-padding">
                      <?= ProductsFeatured::widget(['type'=>"men"]); ?>
                  </div>
               </div>
               <!--end row-->     
            </div>
            <!-- gallery start-->
            <div class="gallery">
               <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 gallery-bg col-padding">
                  <div class="shop-faq-bg">
                  </div>
                  <!--end faq-img-->
                  <div class="chamaripa-img">
                  </div>
                  <!--end chama-img-->
                  <div class="step-img">
                  </div>
                  <!--end chama-img-->
                  <div class="chamaripa-img-3">
                  </div>
                  <!--end chama-img-->    
               </div>
               <!--end col-lg-7-->
               <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 col-padding">
                   <?= OfferSlider::widget(['type'=>"men"]); ?>
               </div>
               <!--end col-lg-5-->
            </div>
            <!-- gallery end-->
            <!-- design slider start-->
			<div class="design-slider">
               <div id="myCarousel-arrow" class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div style="width: 100%; overflow: hidden; height: 350px;" class="frnt-video">
                     <video width="100%" muted="" controls="" autoplay="" loop="" class="home_video">
                        <source type="video/mp4" src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/setting/<?= $product_setting->video ?>"></source>
                     </video>
                  </div>
               </div>
            </div>
          