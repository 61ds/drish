<?php
use common\models\Product;
if($product_ids){
?> 

                        
<ul class="grid cs-style-2">
		<?php
		 foreach($product_ids as $product){  
		 ?>
			<li>
                <figure>
                   <img class="img-responsive" alt="bag" src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/large/<?= $product->productImages[0]->main_image ?>">
                   <figcaption>
                      <h3><?= $product->name ?></h3>
                      <a href="http://dribbble.com/shots/1115960-Music">Shop Now</a>
					</figcaption>
                </figure>
            </li>
			<li>
                <figure>
                   <img class="img-responsive" alt="bag" src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/flip/<?= $product->id ?>/large/<?= $product->productImages[0]->flip_image ?>">
                   <figcaption>
                      <h3><?= $product->name ?></h3>
                      <a href="http://dribbble.com/shots/1115960-Music">Shop Now</a>
					</figcaption>
                </figure>
            </li>
			<li>
                <figure>
                   <img class="img-responsive" alt="bag" src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/home/<?= $product->id ?>/large/<?= $product->productImages[0]->home_image ?>">
                   <figcaption>
                      <h3><?= $product->name ?></h3>
                      <a href="http://dribbble.com/shots/1115960-Music">Shop Now</a>
					</figcaption>
                </figure>
            </li><li>
                <figure>
                   <img class="img-responsive" alt="bag" src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/large/<?= $product->productImages[0]->main_image ?>">
                   <figcaption>
                      <h3><?= $product->name ?></h3>
                      <a href="http://dribbble.com/shots/1115960-Music">Shop Now</a>
					</figcaption>
                </figure>
            </li><li>
                <figure>
                   <img class="img-responsive" alt="bag" src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/home/<?= $product->id ?>/large/<?= $product->productImages[0]->home_image ?>">
                   <figcaption>
                      <h3><?= $product->name ?></h3>
                      <a href="http://dribbble.com/shots/1115960-Music">Shop Now</a>
					</figcaption>
                </figure>
            </li>
			<li>
                <figure>
                   <img class="img-responsive" alt="bag" src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/flip/<?= $product->id ?>/large/<?= $product->productImages[0]->flip_image ?>">
                   <figcaption>
                      <h3><?= $product->name ?></h3>
                      <a href="http://dribbble.com/shots/1115960-Music">Shop Now</a>
					</figcaption>
                </figure>
            </li>
			
		<?php	
				}
			
		?>
</ul>
<?php } ?>