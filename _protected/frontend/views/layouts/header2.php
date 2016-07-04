<?php
use frontend\widgets\HomeMenuLeft;
use frontend\widgets\SliderWid;
use frontend\widgets\CartProductCounter;
use yii\helpers\Url;
use frontend\widgets\Search;
?>
<!--header start-->
<div class="slide-content">
	<header class="slider_top">       
		<div class="container-fluid">
			<div class="row">
       <div class="row">
       <div class="col-lg-1 col-md-1 col-sm-1">
           <a href="<?= Url::to(['site/index']) ?>"><img src="<?= Yii::$app->params['baseurl'] ?>/images/logo-2.png" alt="logo"></a>
       </div><!--col-lg-7-->  
       <div class="col-lg-11 col-md-11 col-sm-11">
       <div class="menu-header">
      	<div class="women-nav">
           <div class="product_type">
               <ul>
                  <li <?php if(Yii::$app->controller->id == 'men'){ echo'style="display:none;"'; }  ?>><a href="<?= Url::to(['men/index']) ?>">Men</a></li>
                  <li>|</li>
				 <li <?php if(Yii::$app->controller->id == 'women'){ echo'style="display:none;"'; }  ?>><a href="<?= Url::to(['women/index']) ?>">Women</a></li>
                 <li <?php if(Yii::$app->controller->id == 'women'){ echo'style="display:none;"'; }  ?>>|</li>
                  <li <?php if(Yii::$app->controller->id == 'children'){ echo'style="display:none;"'; }  ?>><a href="<?= Url::to(['children/index']) ?>">Kids</a></li>
               </ul>
            </div>
       </div>
		<?php if(Yii::$app->user->isGuest){ ?>	   
 		<div class="foot-socials header-social">
           <ul>
                    <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/Sign-in-with-Facebook.png"></a></li>
                    <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/Sign-in-with-Gmail.png"></a></li>  
                     <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/signin-btn.png"></a></li>
           </ul>
           
       </div> 
       <div class="foot-socials mob-social">
           <ul>
                <li><a href="#"><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i aria-hidden="true" class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i aria-hidden="true" class="fa fa-instagram"></i></a></li>  
           </ul>
       </div> 
		<?php } ?>
     	<div class="search-main">
		   <?= Search::widget(['type'=>'first']) ?>
       </div>              
    	<div class="cart-top-header">
             <div class="top-link login-icon mob-cart">
               <ul>
                   <li class="user-icon">
                       <a href="<?= Url::to(['site/login']) ?>" title="login">
                          <i class="glyph-icon flaticon-social-1"></i>
                           <span class="login-text">Login</span>
                       </a>
                   </li>
                <li>
                     <a href="<?= Url::to(['account/wishlist']) ?>"  title="Wishlist">   <div class="heart-area">
						<span class="cart-count">2</span> <i class="fa fa-heart-o"></i>
                        </div> <span class="login-text">Wishlist</span> </a>
                    
                    </li>
                   <li class="cart-icon" title="cart" >
						<div class="cart-box">
							<a href="<?= Url::to(['cart/cart']) ?>">
							<span class="cart-count"><?= CartProductCounter::widget() ?></span>
							<i class="glyph-icon flaticon-cart"></i><span class="login-text">My Cart</span>
							</a>
						</div> 
                   </li>
               </ul>
           </div><!--end top-icon-->
           <!--end top-icon-->
           </div>           
      </div>  
   </div>
   </div><!--col-lg-7-->  
 
   </div>
   <!--end row-->
    <?= HomeMenuLeft::widget([ 'id'=>26 ]) ?>   
   </div>                   
	</header>
</div>
     <?= SliderWid::widget([ 'position'=>"header" , 'controller' => Yii::$app->controller->id ]) ?> 
	 
	 
	 
	