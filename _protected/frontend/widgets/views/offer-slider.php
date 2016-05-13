<?php
use common\models\Product;

if($product_ids){
?> 
 <div data-ride="carousel" class="carousel slide" id="myCarousel-shoes">
    <!-- Indicators -->
     <ol class="carousel-indicators carousel-indicators-2">
		 <?php $i=0;
		  foreach($product_ids as $product){ echo $product->id; ?>
			  <li class="<?php if($i==0){ echo 'active'; }?>" data-slide-to="<?= $i ?>" data-target="#myCarousel-shoes"></li>
		<?php  $i++;  }					 
		 ?>
     </ol>
    <!-- Wrapper for slides -->
        <div role="listbox" class="carousel-inner">
		 <?php $j=1;
		 foreach($product_ids as $product){  
		 ?>
            <div class="item <?php if($j==1){ echo 'active'; }?>">
               <img class="img-responsive" alt="slide-1" src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/flip/<?= $product->id ?>/large/<?= $product->productImages->flip_image ?>">
               <div class="carousel-caption">
                  <div class="price-frame">
                     <h4><?= $product->name ?></h4>
                     <p class="price-txt"><span class="price-doller">$</span><?= $product->price ?><span class="price-zero">.00</span></p>
                     <input type="button" class="shop-now-btn" value="Shop Now &gt;">
                  </div>
                  <!--end price-frame-->
               </div>
            </div>
		<?php $j++;	
			}
		?>
                     </div>
                     <!-- Left and right controls -->
                     <a data-slide="prev" role="button" href="#myCarousel-shoes" class="left carousel-control">
                     <span aria-hidden="true" class="slide-arrow-left-2"><img alt="arrow" src="images/left-arrow.jpg"></span>
                     <span class="sr-only">Previous</span>
                     </a>
                     <a data-slide="next" role="button" href="#myCarousel-shoes" class="right carousel-control live">
                     <span aria-hidden="true" class="slide-arrow-right-2"><img alt="arrow" src="images/right-arrow.jpg"></span>
                     <span class="sr-only">Next</span>
                     </a>
                  </div>
<?php } ?>