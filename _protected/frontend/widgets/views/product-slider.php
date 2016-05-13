<?php
use common\models\Product;
if($product_ids){
?> 
<ul class="bxslider-1 grid cs-style-2">
		<?php
		 foreach($product_ids as $product){  
		 ?>
			<li>
                <a href="category.html">
                   <figure>
                      <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/large/<?= $product->productImages->main_image ?>" />
                      <figcaption>
                         <span><?= $product->name ?><br><i class="fa fa-inr"></i> <?= $product->price ?></span>
                         <button type="button">Shop Now</button>
                      </figcaption>
                   </figure>
                </a>
            </li>
			<li>
                <a href="category.html">
                   <figure>
                      <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/large/<?= $product->productImages->main_image ?>" />
                      <figcaption>
                         <span><?= $product->name ?><br><i class="fa fa-inr"></i> <?= $product->price ?></span>
                         <button type="button">Shop Now</button>
                      </figcaption>
                   </figure>
                </a>
            </li>
			<li>
                <a href="category.html">
                   <figure>
                      <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/large/<?= $product->productImages->main_image ?>" />
                      <figcaption>
                         <span><?= $product->name ?><br><i class="fa fa-inr"></i> <?= $product->price ?></span>
                         <button type="button">Shop Now</button>
                      </figcaption>
                   </figure>
                </a>
            </li>
			<li>
                <a href="category.html">
                   <figure>
                      <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/large/<?= $product->productImages->main_image ?>" />
                      <figcaption>
                         <span><?= $product->name ?><br><i class="fa fa-inr"></i> <?= $product->price ?></span>
                         <button type="button">Shop Now</button>
                      </figcaption>
                   </figure>
                </a>
            </li>
			<li>
                <a href="category.html">
                   <figure>
                      <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/large/<?= $product->productImages->main_image ?>" />
                      <figcaption>
                         <span><?= $product->name ?><br><i class="fa fa-inr"></i> <?= $product->price ?></span>
                         <button type="button">Shop Now</button>
                      </figcaption>
                   </figure>
                </a>
            </li>
			
		<?php	
			}
		?>
</ul>
<?php } ?>