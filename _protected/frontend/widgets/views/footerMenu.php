<?php 
use yii\helpers\Url;
foreach($menus as $key => $parent_menu){
	if($parent_menu['child']){
		echo'<ul class="f-nav privacy">';
		foreach($parent_menu['child'] as $menu){ ?>
			<li><a href="<?= Yii::$app->homeUrl.$menu['link'] ?>" ><?= $menu['name'] ?></a></li>          
<?php	}
		echo'</ul>';
	}
}

?>
