<table class="table">
    <a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success">添加</a>
    <tr>
        <td>编号</td>
        <td>文章名称</td>
        <td>文章分类</td>
        <td>文章排序</td>
        <td>文章简介</td>
        <td>所属分类</td>
        <td>创建时间</td>
        <td>操作</td>
    </tr>
    <?php const STATUS=['下架','上架'];foreach ($models as $model):?>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->sort?></td>
        <td><?=STATUS[$model->status]?></td>
        <td><?=$model->intro?></td>
        <td><?=$model->cate->name?></td>
        <td><?=date('Y-m-d H:i:s',$model->inputtime)?></td>
        <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-success">编辑</a><a href="<?=\yii\helpers\Url::to(['write','id'=>$model->id])?>" class="btn btn-info">写入文章</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-danger">删除</a></td>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pageObj])?>
