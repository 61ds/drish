<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>



        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    [
                        'label' => 'User Management',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'All Users', 'icon' => 'fa fa-file-code-o', 'url' => ['/user'],'active' => ($this->context->route == 'user/index')],
                            ['label' => 'Add New User', 'icon' => 'fa fa-dashboard', 'url' => ['/user/create'],'active' => ($this->context->route == 'user/create')],
                        ],
                    ],

                    ['label' => 'Menu Management', 'icon' => 'fa fa-bars', 'url' => ['/menu'],'active' => ($this->context->route == 'menu/index'),],

                    [   'label' => 'Website Settings',
                        'icon' => 'fa fa-cogs',
                        'url' => ['/setting-attributes/globalsetting'],

                    ],
                    [
                        'label' => 'Pages Management',
                        'icon' => 'fa fa-product-hunt',
                        'url' => 'javascript:void(0);',
                        'items' => [
                            ['label' => 'All Pages', 'icon' => 'fa fa-angle-right', 'url' => ['/pages'],'active' => ($this->context->route == 'pages/index'),],
                            ['label' => 'Add Page', 'icon' => 'fa fa-angle-right', 'url' => ['/pages/create'],'active' => ($this->context->route == 'pages/create'),],

                        ],
                    ],
                    [
                        'label' => 'Product Management',
                        'icon' => 'fa fa-sitemap',
                        'url' => '#',
                        'items' => [
                            ['label' => 'All products', 'icon' => 'fa fa-angle-right', 'url' => ['/product'],'active' => ($this->context->route == 'product/index'),],
                            ['label' => 'Add products', 'icon' => 'fa fa-angle-right', 'url' => ['/product/create'],'active' => ($this->context->route == 'product/create'),],
                        ],
                    ],
                    [
                        'label' => 'Category Management',
                        'icon' => 'fa fa-sitemap',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Category Tree', 'icon' => 'fa fa-angle-right', 'url' => ['/category'],'active' => ($this->context->route == 'category/index'),],
                            ['label' => 'Add/Remove Attributes', 'icon' => 'fa fa-angle-right', 'url' => ['/type'],'active' => ($this->context->route == 'type/index'),],
                        ],
                    ],
                    [
                        'label' => 'Attribute Management',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Attributes', 'icon' => 'fa fa-angle-right', 'url' => ['/attributes'],'active' => ($this->context->route == 'attributes/index')],
                            ['label' => 'Input Type', 'icon' => 'fa fa-angle-right', 'url' => ['/entity'],'active' => ($this->context->route == 'entity/index')],
                        ],
                    ],
                    [
                        'label' => 'Slider Management',
                        'icon' => 'fa fa-picture-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'All Slider', 'icon' => 'fa fa-file-image-o ', 'url' => ['/slider'],],
                            ['label' => 'Add New Slider', 'icon' => 'fa fa-plus', 'url' => ['/slider/create'],],
                        ],
                    ],
                    [
                        'label' => 'Testimonial Management',
                        'icon' => 'fa fa-commenting-o',
                        'url' => 'javascript:void(0);',
                        'items' => [
                            ['label' => 'All Testimonials', 'icon' => 'fa fa-angle-right', 'url' => ['/testimonial'],'active' => ($this->context->route == 'testimonial/index'),],
                            ['label' => 'Add testimonial', 'icon' => 'fa fa-angle-right', 'url' => ['/testimonial/create'],'active' => ($this->context->route == 'testimonial/create'),],

                        ],
                    ],
                ],

            ]
        ) ?>
    </section>

</aside>
