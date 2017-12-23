<table class="table">
    <a href=<?=\yii\helpers\Url::to(['add'])?> class="btn btn-success">添加</a>
    <tr>
        <td>品牌编号</td>
        <td>品牌名称</td>
        <td>品牌简介</td>
        <td>品牌状态</td>
        <td>品牌排序</td>
        <td>品牌logo</td>
        <td>操作</td>
    </tr>
    <?php  const STATUS=['0'=>'禁用','1'=>'激活'];foreach ($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->intro?></td>
        <td><?=STATUS[$model->status]?></td>
        <td><?=$model->sort?></td>
        <td><?=\yii\bootstrap\Html::img($model->logo,['width'=>50])?></td>
        <td><a href=<?=\yii\helpers\Url::to(['brand/edit','id'=>$model->id])?> class="btn btn-success">编辑</a><a href=<?=\yii\helpers\Url::to(['brand/del','id'=>$model->id])?>  class="btn btn-danger">删除</a></td>
    </tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pagObj])?>