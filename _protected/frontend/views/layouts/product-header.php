<?php
use frontend\widgets\HomeMenuMain;
use frontend\widgets\CartProductCounter;
use yii\helpers\Url;
?>
<div class="free-shipping">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2 toggle-width">
                <div class="header">
                    <a href="index.html" class="header-logo"><img src="<?= Yii::$app->params['baseurl'] ?>/images/drish-logo.png" alt="Drish" title="Drish"></a>
                    <a href="#menu" class="menu-bar"> <i class="fa fa-bars"></i></a>
                    <span class="menu-text">Menu</span>
                </div>
                <nav id="menu">
                    <?= HomeMenuMain::widget() ?>
                </nav>


            </div>
            <!--end col-lg-4-->
            <div class="desktop-nav pull-right">
                <div class="col-lg-2 col-md-3 col-sm-3 list-icon">
                    <div class="list_type">
                        <ul>
                            <li><a href="<?= Url::to(['site/men']) ?>">MEN</a></li>
                            <li>|</li>
                            <li><a href="<?= Url::to(['site/women']) ?>">WOMEN</a></li>
                            <li>|</li>
                            <li><a href="<?= Url::to(['site/children']) ?>">CHILDREN</a></li>
                        </ul>
                    </div>
                    <!--end product type-->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-7 col-xs-5 s-icon">
                    <div class="social-area">
                        <ul>
                            <div class="f-desk">
                                <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/Sign-in-with-Facebook.png" alt="facbook" title="facbook" class="img-responsive mob"></a></li>
                                <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/Sign-in-with-Gmail.png" alt="" class="img-responsive mob"> </a></li>
                                <li><a href="#"><img src="<?= Yii::$app->params['baseurl'] ?>/images/signin-btn.png" alt="" class="img-responsive mob"></a></li>
                            </div>
                            <div class="m-desk">
                                <li><a href="#"><i class="fa fa-facebook-square g-icon"></i></a></li>
                                <li><a href="#"><i class="fa fa-google"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </div>
                        </ul>
                    </div>
                    <!--end top-icon-->
                </div>
                <!--end col-lg-5-->
                <div class="col-lg-2 col-md-1 col-sm-1 col-xs-1 border-serach">
                    <div class="search-right mob-serach">   <input type="search" placeholder="Search" class="search-txt"></div>
                    <span class="f-mob-search"><i class="fa fa-search"></i></span>
                </div>
                <!--end col-lg-1-->
                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-4 col-padding login-detail">
                    <div class="top-link login-icon">
                        <ul>
                            <li class="user-icon">
                                <a href="singin-register.html">
                                    <svg enable-background="new 0 0 512 512" id="Layer_1" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                          <path d="M257.107,5C118.473,5,6.109,117.365,6.109,255.998C6.109,394.631,118.473,507,257.107,507  s250.998-112.37,250.998-251.002C508.105,117.365,395.74,5,257.107,5z M257.107,25.917c126.868,0,230.082,103.214,230.082,230.082  c0,55.815-19.997,107.043-53.19,146.926c-22.939-9.58-77.089-28.372-110.609-38.269c-2.859-0.898-3.309-1.042-3.309-12.94  c0-9.826,4.044-19.721,7.987-28.096c4.269-9.1,9.334-24.399,11.153-38.126c5.086-5.904,12.01-17.547,16.463-39.739  c3.901-19.559,2.083-26.677-0.51-33.357c-0.266-0.705-0.552-1.399-0.756-2.094c-0.981-4.586,0.367-28.413,3.718-46.899  c2.308-12.685-0.593-39.658-18.057-61.972c-11.03-14.105-32.131-31.416-70.675-33.826l-21.141,0.02  c-37.891,2.391-59.012,19.701-70.042,33.806c-17.464,22.315-20.364,49.288-18.056,61.963c3.37,18.495,4.698,42.322,3.738,46.816  c-0.204,0.786-0.49,1.481-0.776,2.186c-2.574,6.68-4.412,13.798-0.49,33.357c4.432,22.192,11.357,33.836,16.463,39.739  c1.798,13.726,6.864,29.026,11.153,38.126c3.125,6.659,4.596,15.718,4.596,28.525c0,11.898-0.45,12.042-3.126,12.889  c-34.663,10.234-89.834,30.17-110.404,39.178c-33.846-40.066-54.293-91.785-54.293-148.212  C27.025,129.13,130.239,25.917,257.107,25.917z M96.474,420.516c23.552-9.615,70.512-26.365,101.355-35.475  c17.935-5.658,17.935-20.763,17.935-32.896c0-10.06-0.694-24.89-6.577-37.431c-4.045-8.589-8.662-23.317-9.682-34.847  c-0.225-2.696-1.491-5.188-3.534-6.965c-2.962-2.595-8.988-12.093-12.828-31.252c-3.043-15.167-1.756-18.486-0.51-21.693  c0.531-1.369,1.042-2.717,1.451-4.239c2.512-9.181-0.287-39.341-3.33-56.07c-1.327-7.272,0.347-27.933,13.951-45.337  c12.194-15.595,30.659-24.287,54.211-25.788l19.834-0.021c24.185,1.522,42.65,10.214,54.865,25.809  c13.604,17.404,15.259,38.065,13.93,45.346c-3.023,16.72-5.842,46.879-3.33,56.05c0.43,1.532,0.919,2.88,1.451,4.249  c1.247,3.206,2.533,6.526-0.49,21.693c-3.839,19.16-9.886,28.658-12.848,31.252c-2.022,1.777-3.288,4.269-3.534,6.965  c-1.001,11.53-5.617,26.258-9.661,34.847c-4.637,9.856-9.968,22.98-9.968,37.002c0,12.134,0,27.239,18.118,32.948  c29.516,8.722,76.701,24.93,101.621,34.73c-41.608,41.199-98.781,66.691-161.797,66.691  C194.664,486.084,137.981,461.042,96.474,420.516z" fill="#37404D"/>
                                       </svg>
                                </a>
                            </li>
                            <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                            <li class="cart-icon">
                                <div class="cart-box">
                                    <a href="<?= Url::to(['cart/cart']) ?>">
                                        <span class="cart-count"><?= CartProductCounter::widget() ?></span>
                                        <svg enable-background="new 0 0 64 64" id="Layer_1" version="1.1" viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                             <g>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="19.8" x2="6.6" y1="48.8" y2="10.2"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="16.8" x2="47.3" y1="38.8" y2="38.8"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="19.8" x2="24.7" y1="48.8" y2="48.8"/>
                                                 <circle cx="29.7" cy="48.8" fill="none" r="5" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                                                 <circle cx="48.7" cy="48.8" fill="none" r="5" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="35.6" x2="42.9" y1="48.8" y2="48.8"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="47.3" x2="55.9" y1="38.8" y2="23.9"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="12.2" x2="60.1" y1="23.9" y2="23.9"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="13.8" x2="50.9" y1="31.4" y2="31.4"/>
                                                 <circle cx="48.7" cy="48.8" fill="none" r="1.5" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"/>
                                                 <circle cx="29.7" cy="48.8" fill="none" r="1.5" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="6.6" x2="3.9" y1="10.2" y2="10.2"/>
                                             </g>
                                          </svg>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--end top-icon-->
                    <!--end top-icon-->
                </div>
            </div>
            <div class="mobile-nav">
                <div class="col-lg-5 col-md-7 col-sm-7 col-xs-5 div-1">
                    <div class="social-btn">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                            <li><a href="#"><i class="fa fa-google"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-search"></i></a></li>
                            <li class="user-icon">
                                <a href="#">
                                    <svg enable-background="new 0 0 512 512" id="Layer_1" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                          <path d="M257.107,5C118.473,5,6.109,117.365,6.109,255.998C6.109,394.631,118.473,507,257.107,507  s250.998-112.37,250.998-251.002C508.105,117.365,395.74,5,257.107,5z M257.107,25.917c126.868,0,230.082,103.214,230.082,230.082  c0,55.815-19.997,107.043-53.19,146.926c-22.939-9.58-77.089-28.372-110.609-38.269c-2.859-0.898-3.309-1.042-3.309-12.94  c0-9.826,4.044-19.721,7.987-28.096c4.269-9.1,9.334-24.399,11.153-38.126c5.086-5.904,12.01-17.547,16.463-39.739  c3.901-19.559,2.083-26.677-0.51-33.357c-0.266-0.705-0.552-1.399-0.756-2.094c-0.981-4.586,0.367-28.413,3.718-46.899  c2.308-12.685-0.593-39.658-18.057-61.972c-11.03-14.105-32.131-31.416-70.675-33.826l-21.141,0.02  c-37.891,2.391-59.012,19.701-70.042,33.806c-17.464,22.315-20.364,49.288-18.056,61.963c3.37,18.495,4.698,42.322,3.738,46.816  c-0.204,0.786-0.49,1.481-0.776,2.186c-2.574,6.68-4.412,13.798-0.49,33.357c4.432,22.192,11.357,33.836,16.463,39.739  c1.798,13.726,6.864,29.026,11.153,38.126c3.125,6.659,4.596,15.718,4.596,28.525c0,11.898-0.45,12.042-3.126,12.889  c-34.663,10.234-89.834,30.17-110.404,39.178c-33.846-40.066-54.293-91.785-54.293-148.212  C27.025,129.13,130.239,25.917,257.107,25.917z M96.474,420.516c23.552-9.615,70.512-26.365,101.355-35.475  c17.935-5.658,17.935-20.763,17.935-32.896c0-10.06-0.694-24.89-6.577-37.431c-4.045-8.589-8.662-23.317-9.682-34.847  c-0.225-2.696-1.491-5.188-3.534-6.965c-2.962-2.595-8.988-12.093-12.828-31.252c-3.043-15.167-1.756-18.486-0.51-21.693  c0.531-1.369,1.042-2.717,1.451-4.239c2.512-9.181-0.287-39.341-3.33-56.07c-1.327-7.272,0.347-27.933,13.951-45.337  c12.194-15.595,30.659-24.287,54.211-25.788l19.834-0.021c24.185,1.522,42.65,10.214,54.865,25.809  c13.604,17.404,15.259,38.065,13.93,45.346c-3.023,16.72-5.842,46.879-3.33,56.05c0.43,1.532,0.919,2.88,1.451,4.249  c1.247,3.206,2.533,6.526-0.49,21.693c-3.839,19.16-9.886,28.658-12.848,31.252c-2.022,1.777-3.288,4.269-3.534,6.965  c-1.001,11.53-5.617,26.258-9.661,34.847c-4.637,9.856-9.968,22.98-9.968,37.002c0,12.134,0,27.239,18.118,32.948  c29.516,8.722,76.701,24.93,101.621,34.73c-41.608,41.199-98.781,66.691-161.797,66.691  C194.664,486.084,137.981,461.042,96.474,420.516z" fill="#37404D"/>
                                       </svg>
                                </a>
                            </li>
                            <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                            <li class="cart-icon">
                                <div class="cart-box">
                                    <a href="#">
                                        <span class="cart-count"><?= CartProductCounter::widget() ?></span>
                                        <svg enable-background="new 0 0 64 64" id="Layer_1" version="1.1" viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                             <g>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="19.8" x2="6.6" y1="48.8" y2="10.2"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="16.8" x2="47.3" y1="38.8" y2="38.8"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="19.8" x2="24.7" y1="48.8" y2="48.8"/>
                                                 <circle cx="29.7" cy="48.8" fill="none" r="5" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                                                 <circle cx="48.7" cy="48.8" fill="none" r="5" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="35.6" x2="42.9" y1="48.8" y2="48.8"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="47.3" x2="55.9" y1="38.8" y2="23.9"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="12.2" x2="60.1" y1="23.9" y2="23.9"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="13.8" x2="50.9" y1="31.4" y2="31.4"/>
                                                 <circle cx="48.7" cy="48.8" fill="none" r="1.5" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"/>
                                                 <circle cx="29.7" cy="48.8" fill="none" r="1.5" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"/>
                                                 <line fill="none" stroke="#4D4D4D" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="6.6" x2="3.9" y1="10.2" y2="10.2"/>
                                             </g>
                                          </svg>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--end top-icon-->
                </div>
                <!--end col-lg-5-->
            </div>
            <!--end col-lg-1-->
        </div>
        <!--end col-lg-2-->
        <!--end row-->
    </div>
    <!--end container-fluid-->
</div>