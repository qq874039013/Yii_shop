<table class="table">
    <a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success">添加</a>
    <caption><h3>文章分类列表</h3></caption>
    <tr>
        <td>编号</td>
        <td>分类名称</td>
        <td>分类排序</td>
        <td>分类状态</td>
        <td>分类介绍</td>
        <td>是否分类帮助</td>
        <td>操作</td>
    </tr>
    <?php const STATUS=['禁用','激活'];const ISHELP=['帮助','活动'];foreach ($models as $model):?>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->sort?></td>
        <td><?=STATUS[$model->status]?></td>
        <td><?=$model->intro?></td>
        <td><?=ISHELP[$model->is_help]?></td>
        <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-success">编辑</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-danger">删除</a></td>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pageObj])?>
