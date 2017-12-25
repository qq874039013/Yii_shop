 # shop day1 
 1.单文件上传
 ```php
1.利用 composer require bailangzhan/yii2-webuploader dev-master 更新组件
```
```
2.加入配置文件 在当前应用的prams 中加入'domain' => 'http://域名/',
'webuploader' => [
// 后端处理图片的地址，value 是相对的地址
'uploadUrl' => 'upload',
  // 多文件分隔符
 'delimiter' => ',',
  // 基本配置
 'baseConfig' => [
  'defaultImage' => 'http://img1.imgtn.bdimg.com/it/u=2056478505,162569476&fm=26&gp=0.jpg',
'disableGlobalDnd' => true,
'accept' => [
 'title' => 'Images',
 'extensions' => 'gif,jpg,jpeg,bmp,png',
  	'mimeTypes' => 'image/*',
  ],
 'pick' => [
 'multiple' => false,
 ],
],
],
```
```
3.添加一个方法用来单独上传
/    声明一个单独上传文件的方法
    public function actionUpload(){
    根据name获取文件名
         $img = UploadedFile::getInstanceByName('file');
        $path = "images/brand/".uniqid().".".$img->extension;
        if ($img->saveAs($path,false)) {
        返回json对象
              $row = [
                  'code'=>0,
                  访问路径，根据配置文件进行寻找
                  'url'=>'/'.$path,
                  保存路径
                  'attachment'=>'/'.$path
              ];
            return json_encode($row);
        }
    }
```
4.将页面显示代码
```php 
<?=$form->field($model, 'img')->widget('manks\FileInput', [
    ]);?>
```
5.单独将文件名写入数据库
```php
$model->save()
```
#  单文件衍生出来的多文件上传
只有页面上的代码和upload的方法稍有不同
1.页面上的区别
```php
<?php 
echo $form->field($model, 'file2')->widget('manks\FileInput', [
	'clientOptions' => [
		'pick' => [
		    是否使用多文件上传；
			'multiple' => true,
		],
		// 'server' => Url::to('upload/u2'),
		// 'accept' => [
		// 	'extensions' => 'png',
		// ],
	],
]); ?>
```
2.方法实际上是把数据以逗号形式分开利用遍历循环不断给寄json对象中加入数据
```php
/    声明一个单独上传文件的方法
    public function actionUpload(){
    根据name获取文件名数组
         $img = UploadedFile::getInstancesByName('file');
         循环遍历数组
        foreach ($img as $val) { 
          $path = "images/brand/".uniqid().".".$img->extension;
        $val->saveAs($path,false)
        返回json对象
              $row = [
                  'code'=>0,
                  访问路径，根据配置文件进行寻找
                  'url'=>'/'.$path,
                  保存路径
                  'attachment'=>'/'.$path
              ];
        }
        返回json对象
        return json_encode($row);
    }
```
# RBAC
rbac 基于角色的权限控制
1.在数据库中添加4个表，
1.权限表角色表 通过type字段来区分 type = 1 代表角色 type=2 代表权限 auth_item
```php
name       type
brand/trash	2       ''	1514080216	1514080216
操作员	    1		''	1513994218	1513994218
```
2.角色-权限表 
```php
角色对应有哪些权限 auth_item_child
admin	brand/add
admin	brand/add-trash
admin	brand/del
admin	brand/edit
操作员	brand/edit
```

3.角色-用户表auth_assignment
```php
item_name user_id
admin   	 4	1514006682
admin	     5	1514006858
操作员     	 6	1514006941
查看员	     7	1514007177
查看员	     8	1514015298
```
4.用户表
```php
1.配置文件中  common config main .php
   最后加入  'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
```
####2.单独建立一个控制器用来添加数据
```php

//    声明一个添加权限的方法
    public function actionPre()
    {
        $auth = \Yii::$app->authManager;
        创建权限
        $pre = $auth->createPermission("brand/trash");
        $auth->add($pre);
        // 添加权限
    }
//    声明一个添加角色的方法
    public function actionRole(){
        $auth = \Yii::$app->authManager;
        创建角色
        $role = $auth->createRole();
//        添加权限
        $auth->add($role);
       echo 12232;
    }
//    把权限加入角色
   public function actionRolePre(){
       $auth = \Yii::$app->authManager;
       得到角色
        $role = $auth->getRole('admin');
        得到权限
       $pre = $auth->getPermission("brand/trash");
       添加 角色-权限
       $auth->addChild($role,$pre);
       echo 123;
   }
//  把用户分配给角色
 $auth = \Yii::$app->authManager;
                    $role = $auth->getRole($model->role_pre);
                      $auth->assign($role,$model->id);

```
#### 3在过滤器中添加验证过滤
```php
 public function beforeAction($action)
    {
//        return false;
        if(\Yii::$app->user->can($action->uniqueId)){
            return true;
//            return
        }else{
            throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
        }
    }
   ```
   ####4.在控制器中注入过滤器
   ```php
   注入rbac
//    public function behaviors()
//    {
//        return [[
//            'class'=>CheckFilter::className()
//        ]];
//    }
```