<table class="table">
    <a href=<?=\yii\helpers\Url::to(['add-child'])?> class="glyphicon glyphicon-plus btn btn-success"></a>
    <a href=<?=\yii\helpers\Url::to(['index'])?> class="glyphicon glyphicon-book btn btn-success"></a>
    <tr>
        <td>角色名称</td>
        <td>角色描述</td>
        <td>角色对应权限</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>

        <td><?=$model->name?></td>
        <td><?=$model->description?></td>
        <td><?php   $auth = Yii::$app->authManager;
//        查看角色对应的权限
             foreach ($auth->getChildren($model->name) as $val){
                 echo $val->description.'----';
             } ;
        ?></td>
        <td><a href="<?=\yii\helpers\Url::to(['del-role','name'=>$model->name])?>" class="glyphicon glyphicon-trash btn btn-success"></a><a href="<?=\yii\helpers\Url::to(['edit-role','name'=>$model->name])?>" class="glyphicon glyphicon-edit btn btn-success"></a></td>
    </tr>
    <?php endforeach;?>
</table>