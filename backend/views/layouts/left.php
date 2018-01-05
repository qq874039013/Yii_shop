<aside class="main-sidebar">

    <section class="sidebar" >
        <!-- Sidebar user panel -->
        <div class="user-panel" style="height: 70px;background-color: darkslategrey;">
            <div class="pull-left image" >
                <img src="<?php
                if(\Yii::$app->user->identity){
                    echo \Yii::$app->user->identity->img;}else{
                    echo $directoryAsset."/img/user2-160x160.jpg";
                }
                ?>" class="img-circle"  />
            </div>
            <div class="pull-left info">
                <p> <?php
                    if(\Yii::$app->user->identity){
                    echo \Yii::$app->user->identity->username."  欢迎您！！";
                    }
                    ?></p>
       <span id="timeShow"></span>

                <script language="javascript">
                    var t = null;
                    t = setTimeout(time,1000);//开始执行
                    function time()
                    {
                        clearTimeout(t);//清除定时器
                        dt = new Date();
                        var h=dt.getHours();
                        var m=dt.getMinutes();
                        var s=dt.getSeconds();
                        document.getElementById("timeShow").innerHTML =  "当前时间:"+h+"时"+m+"分"+s+"秒";
                        t = setTimeout(time,1000); //设定定时器，循环执行
                    }
                </script>
            </div>
        </div>
        <!-- /.search form -->
        use mdm\admin\components\MenuHelper;
        <?php
        $callback = function($menu){
            $data = json_decode($menu['data'], true);
            $items = $menu['children'];
            $return = [
                'label' => $menu['name'],
                'url' => [$menu['route']],
            ];
            //处理我们的配置
            if ($data) {
                //visible
                isset($data['visible']) && $return['visible'] = $data['visible'];
                //icon
                isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                //other attribute e.g. class...
                $return['options'] = $data;
            }
            //没配置图标的显示默认图标
            (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'fa fa-circle-o';
            $items && $return['items'] = $items;
            return $return;
        };
        //这里我们对一开始写的菜单menu进行了优化
        echo dmstr\widgets\Menu::widget( [
            'options' => ['class' => 'sidebar-menu'],
            'items' => mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback),
        ] ); ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' =>mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id),

//                'items' => [
//                    ['label' => '会员管理', 'icon' => 'user-o', 'url' => ['admin/index'],],
//                    ['label' => '品牌浏览', 'url' => ['brand/index'],  'icon' => 'grav',],
//                    ['label' => '文章浏览', 'url' => ['article/index'], 'icon' => 'user-circle-o'],
//                    ['label' => '文章分类浏览', 'url' => ['article-category/index'], 'icon' => 'address-book-o'],
//                    ['label' => '促销活动', 'url' => ['promotion/index'],'icon' => 'american-sign-language-interpreting'],
//                    ['label' => '商品分类浏览', 'url' => ['category/index'],'icon'=>'superpowers'],
//                    ['label' => '商品浏览', 'url' => ['goods/index'],'icon'=>'bandcamp'],
//                ],
            ]
        ) ?>

    </section>

</aside>
