<?php
use frontend\widgets\FooterMenu;
?>

<div class="container">
    <div class="row">

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <?= FooterMenu::widget() ?>
            <ul class="f-nav">
                <li><a href="#">CUSTOMER CARE: </a></li>
                <li><a href="mailto:jannatrosha@drish.com">jannatrosha@drish.com</a></li>
                <li><a href="tel:1800 137 0107">Toll Free: 1800 137 0107</a></li>
                <li><a href="#">Free Shipping + Free Returns</a></li>

            </ul>

        </div>
        <div class="col-lg-3 col-md-2 col-sm-12 col-xs-12 f-social">
            <div class="foot-socials">
                <ul>
                    <?php if(Yii::$app->params['settings']['facebook'] !="") { ?>
                        <li><a href="<?= Yii::$app->params['settings']['facebook'] ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <?php } ?>
                    <?php if(Yii::$app->params['settings']['twitter'] !="") { ?>
                        <li><a href="<?= Yii::$app->params['settings']['twitter'] ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <?php } ?>
                    <?php if(Yii::$app->params['settings']['google_plus'] !="") { ?>
                        <li><a href="<?= Yii::$app->params['settings']['google_plus'] ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    <?php } ?>
                    <?php if(Yii::$app->params['settings']['instagram'] !="") { ?>
                        <li><a href="<?= Yii::$app->params['settings']['instagram'] ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <?php } ?>
                    <?php if(Yii::$app->params['settings']['linked_in'] !="") { ?>
                        <li><a href="<?= Yii::$app->params['settings']['linked_in'] ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    <?php } ?>
                    <?php if(Yii::$app->params['settings']['pintrest'] !="") { ?>
                        <li><a href="<?= Yii::$app->params['settings']['pintrest'] ?>" ><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                    <?php } ?>
                    <?php if(Yii::$app->params['settings']['youtube'] !="") { ?>
                        <li><a href="<?= Yii::$app->params['settings']['youtube'] ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                    <?php } ?>


                </ul>
            </div><!--end foot-social-->
            <a href="<?= Yii::$app->homeUrl ?>" class="f-logo-m"><img src="<?= Yii::$app->homeUrl ?>uploads/settings/main/<?= Yii::$app->params['settings']['innerlogo'] ?>" alt="Drish" class="img-responsive foot-logo"></a>

            <p class="copyright">© 2015 drish.  All rights reserved.</p>
        </div><!--end col-lg-2-->
    </div><!--end row-->
</div><!--end container-fluid-->
