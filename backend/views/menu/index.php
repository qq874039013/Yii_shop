<table class="table">
    <a href=<?=\yii\helpers\Url::to(['add'])?> class="glyphicon glyphicon-plus btn btn-success"></a>
    <caption><h3>菜单列表</h3></caption>
    <tr>
        <td>编号</td>
        <td>菜单名称</td>
        <td>图标样式</td>
        <td>菜单路由</td>

        <td>操作</td>
    </tr>
    <?php  foreach ($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->label?></td>
        <td><?=$model->icon?></td>
        <td><?=$model->url?></td>

        <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-success">编辑</a> <a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-danger">删除</a></td>
    </tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pagObj])?>