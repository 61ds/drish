<?php
use frontend\widgets\ProductsSlider;
use frontend\widgets\ProductsFeatured;
?>
<div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12 col-padding">
                     <div class="full-slide">
                        <?= ProductsSlider::widget(['type'=>"kids"]); ?>
                     </div>
                  </div>
                  <!--end col-lg-12-->
               </div>
               <!--end row--->
               <div class="row">
                  <div class="col-lg-12 bag col-padding">
                      <?= ProductsFeatured::widget(['type'=>"kids"]); ?>
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
                  <div data-ride="carousel" class="carousel slide" id="myCarousel-shoes">
                     <!-- Indicators -->
                     <ol class="carousel-indicators carousel-indicators-2">
                        <li class="" data-slide-to="0" data-target="#myCarousel-shoes"></li>
                        <li data-slide-to="1" data-target="#myCarousel-shoes" class=""></li>
                        <li data-slide-to="2" data-target="#myCarousel-shoes" class=""></li>
                        <li data-slide-to="3" data-target="#myCarousel-shoes" class=""></li>
                        <li data-slide-to="4" data-target="#myCarousel-shoes" class="active"></li>
                     </ol>
                     <!-- Wrapper for slides -->
                     <div role="listbox" class="carousel-inner">
                        <div class="item">
                           <img class="img-responsive" alt="slide-1" src="<?= Yii::$app->params['baseurl'] ?>/images/shoe-slide-1.jpg">
                           <div class="carousel-caption">
                              <div class="price-frame">
                                 <h4>Making of<br>Leather Shoe<br>In India</h4>
                                 <p class="price-txt"><span class="price-doller">$</span>500<span class="price-zero">.00</span></p>
                                 <input type="button" class="shop-now-btn" value="Shop Now &gt;">
                              </div>
                              <!--end price-frame-->
                           </div>
                        </div>
                        <div class="item">
                           <img class="img-responsive" alt="slide-1" src="<?= Yii::$app->params['baseurl'] ?>/images/shoe-slide-1.jpg">
                           <div class="carousel-caption">
                              <div class="price-frame">
                                 <h4>Making of<br>Leather Shoe<br>In India</h4>
                                 <p class="price-txt"><span class="price-doller">$</span>500<span class="price-zero">.00</span></p>
                                 <input type="button" class="shop-now-btn" value="Shop Now &gt;">
                              </div>
                              <!--end price-frame-->
                           </div>
                        </div>
                        <div class="item">
                           <img class="img-responsive" alt="slide-1" src="<?= Yii::$app->params['baseurl'] ?>/images/shoe-slide-1.jpg">
                           <div class="carousel-caption">
                              <div class="price-frame">
                                 <h4>Making of<br>Leather Shoe<br>In India</h4>
                                 <p class="price-txt"><span class="price-doller">$</span>500<span class="price-zero">.00</span></p>
                                 <input type="button" class="shop-now-btn" value="Shop Now &gt;">
                              </div>
                              <!--end price-frame-->
                           </div>
                        </div>
                        <div class="item">
                           <img class="img-responsive" alt="slide-1" src="<?= Yii::$app->params['baseurl'] ?>/images/shoe-slide-1.jpg">
                           <div class="carousel-caption">
                              <div class="price-frame">
                                 <h4>Making of<br>Leather Shoe<br>In India</h4>
                                 <p class="price-txt"><span class="price-doller">$</span>500<span class="price-zero">.00</span></p>
                                 <input type="button" class="shop-now-btn" value="Shop Now &gt;">
                              </div>
                              <!--end price-frame-->
                           </div>
                        </div>
                        <div class="item active">
                           <img class="img-responsive" alt="slide-1" src="<?= Yii::$app->params['baseurl'] ?>/images/shoe-slide-1.jpg">
                           <div class="carousel-caption">
                              <div class="price-frame">
                                 <h4>Making of<br>Leather Shoe<br>In India</h4>
                                 <p class="price-txt"><span class="price-doller">$</span>500<span class="price-zero">.00</span></p>
                                 <input type="button" class="shop-now-btn" value="Shop Now &gt;">
                              </div>
                              <!--end price-frame-->
                           </div>
                        </div>
                     </div>
                     <!-- Left and right controls -->
                     <a data-slide="prev" role="button" href="#myCarousel-shoes" class="left carousel-control">
                     <span aria-hidden="true" class="slide-arrow-left-2"><img alt="arrow" src="<?= Yii::$app->params['baseurl'] ?>/images/left-arrow.jpg"></span>
                     <span class="sr-only">Previous</span>
                     </a>
                     <a data-slide="next" role="button" href="#myCarousel-shoes" class="right carousel-control live">
                     <span aria-hidden="true" class="slide-arrow-right-2"><img alt="arrow" src="<?= Yii::$app->params['baseurl'] ?>/images/right-arrow.jpg"></span>
                     <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
               <!--end col-lg-5-->
            </div>
            <!-- gallery end-->
            <!-- design slider start-->
            <div class="design-slider">
               <div data-ride="carousel" class="carousel slide" id="myCarousel-arrow">
                  <!-- Wrapper for slides -->
                  <div class="frnt-video" style="width: 100%; overflow: hidden; height: 350px;">
                     <video class="home_video" width="100%" loop autoplay="" controls muted>
                        <source src="<?= Yii::$app->params['baseurl'] ?>/videos/drish-video.mp4" type="video/mp4">
                     </video>
                  </div>
               </div>
            </div>
            <!-- design slider end-->
            <div class="social-section">
               <div class="row">
                  <div class="col-lg-3 col-sm-6 col-md-6">
                     <div class="news-section">
                        <h1>Newsletter<br>
                           <span>For new offers, fashion updates, sales.</span>
                        </h1>
                        <input type="text" placeholder="your email address"><br>
                        <button type="button">SUBMIT</button>
                     </div>
                     <!--end news-section-->
                  </div>
                  <!--end col-lg-5-->
                  <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                     <div class="facbook-post">   <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FDrish%2F813375862112493&amp;width=454&amp;height=298&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=true&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height: 298px;width: 454px;" allowTransparency="true"></iframe></div>
                  </div>
                  <!--end col-lg-2-->
                  <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                     <div class="facbook-post">   <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FDrish%2F813375862112493&amp;width=454&amp;height=298&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=true&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height: 298px;width: 454px;" allowTransparency="true"></iframe></div>
                  </div>
                  <!--end col-lg-2-->
                  <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                     <div class="winter-area">  <img class="img-responsive" alt="winter-area" src="<?= Yii::$app->params['baseurl'] ?>/images/winter-area-2.jpg"></div>
                  </div>
                  <!--end col-lg-3-->
               </div>
               <!--end row-->
            </div>
            <!-- newsletter end-->