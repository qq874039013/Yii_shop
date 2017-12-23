<table class="table">
    <a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success">添加</a>
    <a href="<?=\yii\helpers\Url::to(['login'])?>" class="btn btn-success">登录</a>
    <tr>
        <td>编号</td>
        <td>用户姓名</td>
        <td>用户密码</td>
        <td>用户性别</td>
        <td>用户头像</td>
        <td>用户权限</td>
        <td>操作</td>
    </tr>
    <?php const STATUS=['男','女'];foreach ($models as $model):?>
        <td><?=$model->id?></td>
        <td><?=$model->username?></td>
        <td><?=$model->password?></td>
        <td><?=STATUS[$model->sex]?></td>
        <td><?=\yii\bootstrap\Html::img($model->img,['height'=>50])?></td>
        <td><?=$model->role_pre?></td>
        <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-success">编辑</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-danger">删除</a></td>
        </tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pageObj])?>
