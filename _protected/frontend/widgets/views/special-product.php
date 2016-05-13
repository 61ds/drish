<?php
use common\models\Product;
if($product_ids){
?> 
<div class="slider-product">
    <ul class="bxslider-pros">
		<?php
		 foreach($product_ids as $id){
			 $product = Product::findOne($id); ?>
			 <li>
				 <div class="sreen-gallery">
                            <a href="#"><?= $product->name ?></a>
                            <img src="<?= Yii::$app->params['baseurl'] ?>/uploads/product/main/<?= $product->id ?>/medium/<?= $product->productImages->main_image ?>" alt="complete-view" title="coplete-view" style="width:250px;height:250px;">

                            <span class="price"><i class="fa fa-inr"></i> <?= $product->price ?></span>
                            <ul class="product-view">

                                <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/icon_list_view_detail_normal_state.png" alt="View" title="Viewt"></a></li>
                                <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/icon_list_view_cart_normal_state.png" alt="cart" title="Cart"></a></li>
                                <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/icon_list_view_wishlist_normal_state.png" alt="pinterest" title="pinterest"></a></li>

                            </ul>
					</div>
			</li>
			
		<?php }
		?>

    </ul>
</div>
<?php } ?>