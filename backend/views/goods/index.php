<table class="table">
    <a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success">添加</a>
    <tr>
        <td>编号</td>
        <td>商品名称</td>
        <td>商品排序</td>
        <td>货号</td>
        <td>库存</td>
        <td>商品分类</td>
        <td>商品logo</td>
        <td>品牌分类</td>
        <td>商品状态</td>
        <td>商场价格</td>
        <td>本店价格</td>
        <td>创建时间</td>
        <td>操作</td>
    </tr>
    <?php const STATUS=['隐藏','显示'];foreach ($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->sort?></td>
            <td><?=$model->sn?></td>
            <td><?=$model->stock?></td>
            <td><?=$model->cate->name?></td>
            <td><?=\yii\bootstrap\Html::img($model->logo,['height'=>50])?></td>
            <td><?=$model->brand->name?></td>
            <td><?=STATUS[$model->is_on_sale]?></td>
            <td><?=$model->market_price?></td>
            <td><?=$model->shop_price?></td>
            <td><?=$model->inputtime?></td>
        <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-success">编辑</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-danger">删除</a></td>
        </tr>
    <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget(['pagination' => $pageObj])?>
