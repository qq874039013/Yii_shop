<div class="pull-left"><a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success">添加</a></div>
<table class="table">
    <caption><h3>会员列表</h3></caption>
    <tr>
        <td>id</td>
        <td>用户名</td>
        <td>邮箱</td>
        <td>添加时间</td>
        <td>最后的登录时间</td>
        <td>最后的登录ip</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->username?></td>
            <td><?=$model->email?></td>
            <td><?=$model->add_time?></td>
            <td><?=$model->last_login_time?></td>
            <td><?=long2ip($model->last_login_ip)?></td>
        <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-success">编辑</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-danger">删除</a></td>
        </tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pageObj])?>
