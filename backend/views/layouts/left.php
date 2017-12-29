<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">

              <span class="input-group-btn">


              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [

                    ['label' => '登录', 'icon' => 'american-sign-language-interpreting','url' => ['admin/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => '品牌浏览', 'url' => ['brand/index'], 'visible' => Yii::$app->user->isGuest,'icon' => 'grav',],
                    ['label' => '文章浏览', 'url' => ['article/index'], 'visible' => Yii::$app->user->isGuest,'icon' => 'user-circle-o'],
                    ['label' => '文章分类浏览', 'url' => ['article-category/index'], 'visible' => Yii::$app->user->isGuest,'icon' => 'user-o'],
                    ['label' => '促销活动', 'url' => ['promotion/index'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => '商品分类浏览', 'url' => ['category/index'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => '商品浏览', 'url' => ['goods/index'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'american-sign-language-interpreting', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
