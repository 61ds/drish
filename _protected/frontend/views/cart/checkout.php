<?php
use frontend\widgets\AddressForm;
use frontend\widgets\ShippingForm;
use frontend\widgets\PaymentForm;
use frontend\widgets\ReviewOrder;
?>
   <section class="cart-detail-outer">
    
   		<div class="container">
        
   			<div class="row">
   				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
   					<h2>Checkout</h2>	 
					<div class="bredcrumb-nav">
           		 	<ul>
            			<li><a href="index.html">Home</a></li>
                		<li class="active"><a href="#">Checkout</a></li>
           		  </ul>
        		</div> 
</div>
			</div>
           
	<!-- end of bredcrum--> 
    
   <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
            <ul class="address">
              <li class="step1">
                <span class="open">1. Addresses<i class="fa fa-plus fa-minus"></i></span>
                <div style="display:block;" class="detail-shipping">
                
                <div class="address-tab">
                 <h5>Billing Address</h5>
                    <?= AddressForm::widget() ?>

                </div>
                
      			</div>
              </li> 
              <li class="step2">
                    <span>2. Shipping Method<i class="fa fa-plus"></i></span>
                    <?= ShippingForm::widget() ?>
              </li>
              <li class="step3">
                <span>3. Payment Information<i class="fa fa-plus"></i></span>
                  <?= PaymentForm::widget() ?>
              </li>
              <li class="step4">
                <span>4. Order Review<i class="fa fa-plus"></i></span>
                  <?= ReviewOrder::widget() ?>
              </li>
              
            </ul>
          </div>
        </div>
    
    
 </div>
    
</section>