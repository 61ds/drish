
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$user_id = \Yii::$app->user->identity->id;
?>

		<div class="account-information">
			<div class="acount-arrow"><img title="edit" alt="edit" src="/uploads/site/medium/account-arrow.png"></div>
			<div class="row">
				<div class="account-create">
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
						<h3>My Applications</h3>
					</div>

				</div>
			</div>
			<?php if($model){
				$i=1;
				foreach($model as $models){
				$basic_data = $models->getBasicApplicationData($models->id);
				$education_data = $models->getEducationApplicationData($models->id);
				$address_data = $models->getAddressApplicationData($models->id);
				?>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h4><strong><?= $i ?>.</strong> <a href="<?= Url::to(['account/application','app_id' => $models->id]) ?>"> Click Here</a> to View Application</h4>
					</div>		
				</div>
			<?php $i++; }
			}else{ ?>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h4> No applications submitted by you.</h4>
					</div>		
				</div>
		   <?php } ?>








            
			