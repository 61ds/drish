<?php
use common\models\Product;
use yii\helpers\Url;
if($product_ids){
?> 

                        
<ul class="grid cs-style-2">
		<?php
		 foreach($product_ids as $product){  
		 ?>
			<li>
                <figure>
                   <img class="img-responsive" alt="bag" src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/custom2/<?= $product->productImages->main_image ?>">
                   <figcaption>
                      <h3><?= $product->name ?></h3>
                      <a href="<?= Url::to(['men/product','slug'=>$product->slug]) ?>">Shop Now</a>
					</figcaption>
                </figure>
            </li>
			
		<?php	
				}
			
		?>
</ul>
<?php } ?>