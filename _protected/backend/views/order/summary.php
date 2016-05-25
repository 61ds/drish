<?php
$this->registerCss('    .tab-pane{
        display:none;
    }
    .active{
        display:block;
    }');

?>


<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Order Summary</li>
            <li ><a href="#tab_2" data-toggle="tab">Address</li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">

        </div>
        <div class="tab-pane active" id="tab_2">

        </div>

    </div>

</div>
