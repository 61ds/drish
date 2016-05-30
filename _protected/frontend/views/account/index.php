
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
		<div class="account-information">
			<div class="acount-arrow"><img title="edit" alt="edit" src="<?= Yii::$app->params['baseurl'] ?>/uploads/account-arrow.png"></div>
			<div class="row">
				<div class="account-create">
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
						<h3>My Dashboard</h3>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h4> Orders Made by you. <a href="<?= Url::to(['account/orders']) ?>">Click here</a> to search Order</h4>

				</div>		
				
			</div>
			<div class="row">
				<div class="account-create">
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
						<h3>Account Info</h3>
					</div>
		
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h4> <a href="<?= Url::to(['/account/information']) ?>">Click here</a> to manage your account</h4>

				</div>		
				
			</div>			
		</div>