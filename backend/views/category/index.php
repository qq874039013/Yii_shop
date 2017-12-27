<table class="table">
    <a href=<?=\yii\helpers\Url::to(['add'])?> class="glyphicon glyphicon-plus btn btn-success"></a>
    <tr>
        <td>编号</td>
        <td>商品分类</td>
        <td>上级分类</td>
        <td>左对齐</td>
        <td>右对齐</td>
        <td>顶级</td>
        <td>介绍</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->parent_id?></td>
        <td><?=$model->lft?></td>
        <td><?=$model->rgt?></td>
        <td><?=$model->depth?></td>
        <td><?=$model->intro?></td>
        <td><a href=<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?> class="glyphicon glyphicon-edit btn btn-success"></a><a href=<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>  class="glyphicon glyphicon-remove-circle btn btn-danger"></a></td>
</tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pagObj])?>