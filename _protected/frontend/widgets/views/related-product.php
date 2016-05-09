<?php
use common\models\Product;
if($product_ids){
?> 
<h3>Related product</h3>
<div class="slider-product">
    <ul class="bxslider-pro">
		<?php
		 foreach($product_ids as $id){
			 $product = Product::findOne($id); ?>
			 <li>
				<span class="related-product">
						<a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/large/<?= $product->productImages[0]->main_image ?>">
						  <h4><?= $product->name ?></h4>
						<h4><span><i class="fa fa-inr"></i></span><?= $product->price ?></h4></a>
				 </span>
			</li>
			
		<?php }
		?>

    </ul>
</div>
<?php } ?>