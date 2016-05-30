
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\modules\admin\models\University;
$user_id = \Yii::$app->user->identity->id;
$model = unserialize($wishlist->uni_courses);
?>
<?php $this->title =  ' My WishList'; ?>
			<div class="acount-arrow"><img title="edit" alt="edit" src="/uploads/site/medium/account-arrow.png"></div>
			<div class="row">
				<div class="account-create">
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
						<h3>My WishList</h3>
					</div>

				</div>
			</div> 
			<?php if($model){ ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main_wish">
			<?php	foreach($model as $wishlistid){
					$id = $wishlistid;
					$get_university = University::findOne($id); ?>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="wish_div">
						<a data-id="<?= $id ?>" href="<?= Url::to([ 'wishlist/remove', 'id' => $id]) ?>" class="wishremove" title="Remove from Wishlist" >Remove</a>
					</div>
						<div class="related-uni">
							<a href="<?= Url::to([ 'university/index', 'slug' => $get_university->slug]) ?>">
							<img class="" src="<?= Yii::$app->request->baseUrl ?>/uploads/medium/university/banners/<?= $get_university->banner ?>">
							<div class="related-text">
								<h5><?= $get_university->sname ?></h5>
								<p><?= $get_university->name ?></p>
							</div></a>
						</div>
					</div>			
			<?php }	?>
				
			</div>	
			<?php }
			else{ ?>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h4> No Course added by you.</h4>
					</div>		
				</div>
		   <?php } ?>

	<style>		
	.related-uni img {
		height: 220px;
	}
	</style>		