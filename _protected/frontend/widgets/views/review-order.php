<?php
use yii\helpers\Html;
?>


<?php    if(isset($items['items']) && count($items['items']) > 0){
?>
    <table id="checkout-review-table" class="data-table table">
        <colgroup><col>
            <col width="1">
            <col width="1">
            <col width="1">
        </colgroup>
        <thead>
            <tr class="first last">
            <th rowspan="1">Product Name</th>
            <th class="a-center" colspan="1">Price</th>
            <th class="a-center" rowspan="1">Qty</th>
            <th class="a-center" colspan="1">Subtotal</th>
            </tr>
        </thead>

        <tfoot>
            <tr class="first">
                <td colspan="3" class="a-right" style="">
                Subtotal    </td>
                <td class="a-right last" style="">
                <span class="price"><i aria-hidden="true" class="fa fa-inr"></i><?= $items['total'] ?></span>    </td>
            </tr>
            <tr>
                <td colspan="3" class="a-right" style="">
                Shipping &amp; Handling (Free Shipping - Free)    </td>
                <td class="a-right last" style="">
                <span class="price"><i aria-hidden="true" class="fa fa-inr"></i>0.00</span>    </td>
            </tr>
            <tr>
                <td class="a-right" style="" colspan="3">
                Cash On Delivery            </td>
                <td class="a-right last" style="">
                <span class="price"><i aria-hidden="true" class="fa fa-inr"></i>0.00</span>            </td>
            </tr>
            <tr class="last">
                <td colspan="3" class="a-right" style="">
                <strong>Grand Total</strong>
                </td>
                <td class="a-right last" style="">
                <strong><span class="price"><i aria-hidden="true" class="fa fa-inr"></i><?= $items['total'] ?></span></strong>
                </td>
            </tr>
        </tfoot>

        <tbody>
            <?php

            foreach($items['items'] as $key=>$item){ ?>

                <tr class="first odd">
                <td><h3 class="product-name"><?= $item['name'] ?></h3>
                <dl class="item-options">
                <dt>Color</dt>
                <dd><?= $item['color'] ?> </dd>
                <dt>Size</dt>
                <dd><?= $item['size'] ?></dd>
                <dt>Width</dt>
                <dd><?= $item['width'] ?></dd>
                </dl>
                </td>
                <td class="a-right">
                <span class="cart-price">

                <span class="price"><i aria-hidden="true" class="fa fa-inr"></i><?= $item['singleprice'] ?></span>
                </span>


                </td>
                <td class="a-center"><?= $item['quantity'] ?></td>
                <!-- sub total starts here -->
                <td class="a-right last">
                <span class="cart-price">

                <span class="price"><i aria-hidden="true" class="fa fa-inr"></i><?= $item['price'] ?></span>
                </span>
                </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

    <hr class="border-line">
    <div class="btn-cart red-btn">

        <?= Html::submitButton('Place Order') ?>
    </div>



<?php  } else{
    ?>
 No products in your cart.
    <?php
} ?>
