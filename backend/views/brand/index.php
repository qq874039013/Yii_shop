<table class="table">
    <a href=<?=\yii\helpers\Url::to(['add'])?> class="glyphicon glyphicon-plus btn btn-success"></a><a href=<?=\yii\helpers\Url::to(['brand/trash'])?> class="glyphicon glyphicon-trash btn btn-danger"></a><a href=<?=\yii\helpers\Url::to(['brand/index'])?> class="glyphicon glyphicon-home btn btn-info"></a>

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
        <td><?=mb_substr($model->intro,0,20)?></td>
        <td><span <?php if($model->status==0){echo 'class="glyphicon glyphicon-remove"';}if($model->status==1){echo  'class="glyphicon glyphicon-ok"';}?>><?=STATUS[$model->status]?></span></td>
        <td><?=$model->sort?></td>
        <td><?=\yii\bootstrap\Html::img($model->logo,['width'=>50])?></td>
        <td><a href=<?=\yii\helpers\Url::to(['brand/edit','id'=>$model->id])?> class="glyphicon glyphicon-edit btn btn-primary"></a><a href=<?=\yii\helpers\Url::to(['brand/del','id'=>$model->id])?>  class="glyphicon glyphicon-remove-circle btn btn-warning"></a><a href=<?=\yii\helpers\Url::to(['brand/add-trash','id'=>$model->id])?>  <?php  if($model->status==0){echo 'class="glyphicon glyphicon-upload btn btn-success "';}if($model->status==1){echo  'class="glyphicon glyphicon-download btn btn-danger"';}?>></a></td>
    </tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pagObj])?>