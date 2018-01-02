<table class="table">
    <a href=<?=\yii\helpers\Url::to(['add-role'])?> class="glyphicon glyphicon-plus btn btn-success"></a>
    <a href=<?=\yii\helpers\Url::to(['index'])?> class="glyphicon glyphicon-book btn btn-success"></a>
    <tr>
        <td>角色名称</td>
        <td>角色描述</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>

        <td><?php if(strpos($model->parent,'/')){echo '-----'.$model->name;}else{
            echo $model->parent;}?></td>
        <td><?=$model->child?></td>
        <td><a href="<?=\yii\helpers\Url::to(['permission/del-child','name'=>$model->parent,'child'=>$model->child])?>" class="glyphicon glyphicon-trash btn btn-success"></a></td>
    </tr>
    <?php endforeach;?>
</table>