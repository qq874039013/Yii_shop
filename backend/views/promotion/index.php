<table class="table">
    <a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success">添加</a>
    <caption><h3>活动列表</h3></caption>
    <tr>
        <td>编号</td>
        <td>活动主题</td>
        <td>开始时间</td>
        <td>结束时间</td>
        <td>参与商品</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->title?></td>
            <td><?=$model->start_time?></td>
            <td><?=$model->end_time?></td>
            <td><?php $i = 0;  foreach ($model->pro as $val){
                echo ++$i."号商品:".\backend\models\Goods::findOne($val->goods_id)->name.'&emsp;';
                }?></td>

        <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-success">编辑</a> <a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-danger">删除</a></td>
        </tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pageObj])?>
