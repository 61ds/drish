<?php
use common\models\Product;
use yii\helpers\Url;
if($product_ids){
	if($type == "kids"){ ?>
		<ul class="bxslider-2">
		
	<?php	foreach($product_ids as $product){  
		 ?>	
			<li>
               <a href="<?= Url::to(['men/product','slug'=>$product->slug]) ?>">
                    <figure>
						  <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/custom2/<?= $product->productImages->main_image ?>" class="img-responsive" alt="<?= $product->name ?>" title="<?= $product->name ?>">
                    </figure>
                </a>
            </li>
		<?php	
			}
		?>
		</ul>
<?php
	} else {
?>                        
<ul class="bxslider-1 grid cs-style-2">
		<?php
		 foreach($product_ids as $product){  
		 ?>
			 <li>
                    <a href="<?= Url::to(['men/product','slug'=>$product->slug]) ?>">
                        <figure>
                            <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/custom2/<?= $product->productImages->main_image ?>" class="img-responsive" alt="bag-1" title="bag-1">
                            <figcaption>
                           <span><?= $product->name ?><br><i class="fa fa-inr"></i><?= $product->price ?></span>
                                <button type="button">Shop Now</button>
                            </figcaption>
                        </figure>
                    </a>
                      
            </li>
		<?php	
			}
		?>
</ul>
<?php }

} ?>