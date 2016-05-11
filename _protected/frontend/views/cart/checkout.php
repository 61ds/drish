<?php
use frontend\widgets\AddressForm;
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
              <li>
                <span>1. Addresses<i class="fa fa-plus fa-minus"></i></span>
                <div style="display:block;" class="detail-shipping">
                
                <div class="address-tab">
 <h5>Billing Address</h5>
	<?= AddressForm::widget() ?>

</div>
                
      			</div>
              </li> 
              <li>
                <span>2. Shipping Method<i class="fa fa-plus"></i></span>
                 <div class="detail-shipping">
                 <div class="shipping-main">
           <div class="shipping-method">
            <div class="free-s">Free Shipping</div>
            <div class="rupe-s">Free <i class="fa fa-inr"></i>0.00</div>
          </div> 
            <!-- end of contact information fiels-->
             	<hr class="border-line">
            <div class="btn-cart red-btn">   <button type="button" class="blk-btn">BACK</button> <button type="button">CONTINUE</button> </div>
			</div>
                </div>
              </li>
              <li>
                <span>3. Payment Information<i class="fa fa-plus"></i></span>
                 <div class="detail-shipping">asdfasdf
                </div>
              </li>
              <li>
                <span>4. Order Review<i class="fa fa-plus"></i></span>
                <div class="detail-shipping">Order Review  </div>
              </li>
              
            </ul>
          </div>
        </div>
    
    
 </div>
    
</section>