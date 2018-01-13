<div class="topnav_right fr">
    <ul>
        <?php if(Yii::$app->user->identity){?>
            <li><?=Yii::$app->user->identity->username ?> 您好，欢迎来到京西！[<a href="<?=\yii\helpers\Url::to(['member/address'])?>">个人详情</a>] [<a href="<?=\yii\helpers\Url::to(['user/logout'])?>">退出登录</a>] </li>
        <?php  }else{?>
            <li>您好，欢迎来到京西！[<a href="<?=\yii\helpers\Url::to(['user/login'])?>">登录</a>] [<a href="<?=\yii\helpers\Url::to(['user/regist'])?>">免费注册</a>] </li>
        <?php }?>
        <li class="line">|</li>
        <li>我的订单</li>
        <li class="line">|</li>
        <li>客户服务</li>

    </ul>
</div>