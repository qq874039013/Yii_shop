<table class="table">
    <a href=<?=\yii\helpers\Url::to(['add'])?> class="glyphicon glyphicon-plus btn btn-success"></a>
    <a href=<?=\yii\helpers\Url::to(['show'])?> class="glyphicon glyphicon-user btn btn-success"></a>
    <tr>
        <td>权限名称</td>
        <td>权限描述</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>

        <td><?php if(strpos($model->name,'/')){echo '-----'.$model->name;}else{
            echo $model->name;}?></td>
        <td><?=$model->description?></td>
        <td><a href="<?=\yii\helpers\Url::to(['del','name'=>$model->name])?>" class="glyphicon glyphicon-trash btn btn-success"></a></td>
    </tr>
    <?php endforeach;?>
</table>