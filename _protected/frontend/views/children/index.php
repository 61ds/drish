<?php
use frontend\widgets\ProductsSlider;
use frontend\widgets\ProductsFeatured;
use frontend\widgets\OfferSlider;
?>
<!-- menu-end-->
	<div class="kids-shoe-banner">
		<img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/setting/main/<?= $product_setting->banner ?>" class="img-responsive" alt="kids-shoe-banner" title="kids-shoe-banners">
	</div>
	<section class="kids-slider">
        <div class="full-slide"> 
		<?php if($kidslider){ ?>
			<ul class="bxslider-2">
			<?php foreach($kidslider as $kid){?>
            	<li>
                    <a href="<?= $kid->url ?>">
                    	<img src="<?= Yii::$app->params['baseurl'] ?>/uploads/slides/large/<?= $kid->img ?>" alt="<?= $kid->img_title ?>" title="<?= $kid->img_title ?>">
                    </a>
                </li>
			<?php } ?>
			</ul>
		<?php } ?>
        </div>
	</section>
<!-- end of kids slide-->
<?php 
		if( $product_setting->testimonial_banner){ ?>
			<div class="kids-shoe-banner">
				<img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/setting/main/<?= $product_setting->testimonial_banner ?>" class="img-responsive" alt="kids-shoe-banner" title="kids-shoe-banners">
			</div>
	<?php }else{ ?>
<section class="kids-proud">
    <div class="help-raise">
		<div class="container">
			<div class="row">
			
				 <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
					<div class="proud-text">
						<p> <i class="fa fa-quote-left" aria-hidden="true"></i>
						<?= $testimonial->descr ?> 
						<i class="fa fa-quote-right" aria-hidden="true"></i>
						</p>
					</div>
				</div>
				<div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
					<div class="proud-child">
						<img src="<?= Yii::$app->params['baseurl'] ?>/uploads/testimonial/large/<?= $testimonial->feat_image ?>" alt="kids-girl" title="kids-girl">
					</div>
				</div>
			</div>
        </div>
    </div>

</section>
	<?php } ?>
<div class="outer-container">
        <div class="kids-section">
		<?php

		if($kidsetting){
		$i = 1;
		?>
        	<ul>
			<?php foreach($kidsetting as $kid){ 
				if($i>4){ break; }
			?>
            	<li style='margin-left:20px;'>
                    <a href="<?= $kid->url ?>">
                    	<img src="<?= Yii::$app->params['baseurl'] ?>/uploads/slides/large/<?= $kid->img ?>" alt="<?= $kid->img_title ?>" title="<?= $kid->img_title ?>">
                    </a>
                </li>
			<?php
				$i++;
			} ?>
            </ul>
		<?php } ?>
    </div>
</div>


 <!-- end of child section-->