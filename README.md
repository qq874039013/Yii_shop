# 1. 项目介绍
### 1.1项目描述简介
##### 类似京东商城的B2C商城 (C2C B2B O2O P2P ERP进销存 CRM客户关系管理) 电商或电商类型的服务在目前来看依旧是非常常用，虽然纯电商的创业已经不太容易，但是各个公司都有变现的需要，所以在自身应用中嵌入电商功能是非常普遍的做法。为了让大家掌握企业开发特点，以及解决问题的能力，我们开发一个电商项目，项目会涉及非常有代表性的功能。
# 1.2.主要功能模块
#### 系统包括：
##### 后台：品牌管理、商品分类管理、商品管理、
##### 订单管理、系统管理和会员管理六个功能模块。
##### 前台：首页、商品展示、商品购买、订单管理、在线支付等。
### 1.3.开发环境和技术
##### 1.开发环境:	Window
##### 2.开发工具: Phpstorm+PHP5.6+GIT+Apache
##### 3.相关技术: Yii2.0+CDN+jQuery+sphinx
##### 1.4项目人员组成周期成本
#### 1.4.1人员组成


职位  | 人数 | 备注 
---|---|---
项目组长或者经理|1 | 小型公司 一般 是项目经理  中大型公司一般是项目组长
开发人员 | 3
ui人员 | 0
前端开发人员 | 1|前端人员也做ui开发
测试人员| 1


* 公司有测试部，测试部负责所有项目的测试。
* 项目测试由产品经理进行业务测试。
* 项目中如果有测试，一般都具有Bug管理工具(现都被集成在项目管理工具中)。
### 1.4.2.项目周期成本

人数  | 周期  | 备注
---|--|--
1 |	两周需求及设计|	项目经理
1 |	两周|UI设计	UI/UE4
（1测试 2后端 1前端|	3个月(第1周需求设计,9周时间完成编码, 2周时间进行测试和修复)|	开发人员、测试人员

### 2.1.需求

- [x]  品牌管理：
- 品牌管理难点/上传图片  七牛云
 ```
 //    声明一个单独上传文件的方法
    public function actionUpload(){
        $config = [
            'accessKey' => 'EAd29Qrh05q78_cZhajAWcbB1wYCBLyHLqkanjOG',//AK
            'secretKey' => '_R5o3ZZpPJvz8bNGBWO9YWSaNbxIhpsedbiUtHjW',//SK
            'domain' => 'http://p1ht4b07w.bkt.clouddn.com',//临时域名
            'bucket' => 'php0830',//空间名称
            'area' => Qiniu::AREA_HUADONG//区域
        ];

//var_dump($_FILES);exit;
        $qiniu = new Qiniu($config);
//var_dump($qiniu);exit;
        $key = uniqid();//上传后的文件名  多文件上传有坑
        $qiniu->uploadFile($_FILES['file']["tmp_name"], $key);//调用上传方法上传文件
        $url = $qiniu->getLink($key);//得到上传后的地址
        //返回的结果
        $result = [
            'code' => 0,
            'url' => $url,
            'attachment' => $url

        ];
        return json_encode($result);
    }
 ```
- 删除图片的时候
```
//    声明一个删除的方法
    public function actionDel($id)
    {
        $model = Brand::findOne($id);
        if(file_exists(ltrim($model->logo,'/'))){
            unlink(ltrim($model->logo,'/'));
        }
        if ($model->delete()) {
          return $this->redirect(['index']);
        }
    }
```
 
- [x]  文章管理：
- [x]  商品分类管理：
- [x]  商品管理：
- [x]  账号管理：
- [x]  权限管理：
RBAC
基于权限的控制
权限表 与角色表放置在一起 ，用type 的值来进行区分。type=1是角色，type=2 是权限

增  | 删 | 改 | 查
--- | --- |--- |---
```
实例化$auth =  \Yii::$app->authManager; 创建权限 
$pre = $auth->createPermission($model->name); 
添加描述
  $pre->description=$model->description;
  $auth->add($pre);
  删
    $auth = \Yii::$app->authManager;
       $pre = $auth->getPermission($name);
        if ($auth->remove($pre)
        改
        由于name是主键不能更改重复
        只能更改描述 description 
           $child = $auth->getPermission($val);
           $child->decription = $model->description;
                $auth->update($name,$child);
            
                查
                 //    声明一个方法用来查看权限表
        $model =\Yii::$app->authManager->getPermissions();

        
  ```
角色表
```
实例化$auth =  \Yii::$app->authManager; 创建角色 
$role = $auth->createRole($model->name); 
添加描述
  $role->description=$model->description;
  $auth->add($role);
  删
    $auth = \Yii::$app->authManager;
       $role = $auth->getRole($name);
        if ($auth->remove($role)
        改
        由于name是主键不能更改重复
        只能更改描述 description 
           $child = $auth->getRole($val);
           $child->decription = $model->description;
                $auth->update($name,$child);
                查
                 //    声明一个方法用来查看权限表
        $model =\Yii::$app->authManager->getRoles();
  ```
角色-权限表
```
实例化$auth =  \Yii::$app->authManager; 
得到角色 
$role = $auth->getRole($model->name); 
$pre = $auth->getPremission($model->name);
添加描述
  $auth->addchild($role,$pre);
  删
     $auth = \Yii::$app->authManager;
        $role = $auth->getRole($name);
//        先删除角色对应的权限
        $auth->removeChildren($role);
//        然后在删除角色
        if ($auth->remove($role)){
        改先删除所有的角色对应的权限，然后在进行添加
       //            判断角色是否存在
            if($auth->getRole($model->role)==false){
                $parent = $auth->getRole($name);
            }else{
                $parent = $auth->getRole($model->role);
//                覆盖掉以前的角
                 echo "<script>alert('是否要覆盖掉存在的角色')</script>";
                $parent = $auth->getRole($model->role);
                $parent2 = $auth->getRole($name);
                //                先移除以前的角色对应的权限
                $auth->removeChildren($parent2);
                $auth->remove($parent2);
            }
            //                删除角色以前对应的权限
            $auth->removeChildren($parent);
//            在移除角色
            $auth->remove($parent);

//            重新创建角色
            $role = $auth->createRole($model->role);
//            添加描述
            $role->description = $model->description;
//            把角色添加进去
            $auth->add($role);
            $parent = $auth->getRole($model->role);
            $auth->removeChildren($parent);
            foreach ($model->pre as $val) {
//                给角色添加权限
                $child = $auth->getPermission($val);
                $auth->addChild($parent,$child);
            }
                查
                $model =\Yii::$app->authManager->getRoles();
                <?php   $auth = Yii::$app->authManager;
//        查看角色对应的权限
             foreach ($auth->getChildren($model->name) as $val){
                 echo $val->description.'----';
             } ;
        ?>
        return $this->render('show',['models'=>$model]);
         

```
角色-会员表
  ```
  增 给会员分配角色
  $model = new AuthItem();
//        得到所有的用户
        $admin = Admin::find()->asArray()->all();
        $admin = ArrayHelper::map($admin,'id','username');
        $auth = \Yii::$app->authManager;
//        得到所有的角色
        $role = $auth->getRoles();
        $role = ArrayHelper::map($role,'name','description');
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
//            得到角色
            foreach ($model->adminId as $val){
//                添加角色对应的用户
                foreach ($model->roles as $v){
                <!--先移除在进行添加不然会报错-->
                 $role = $auth->getRole($v);
                   $auth->revoke($role,$val);
                    $auth->assign($role,$val);
                }
            }
            \Yii::$app->session->setFlash('success',"添加会员到".$model->role."角色成功");
            $this->refresh();
        }
        return $this->render('addadmin',['role'=>$role,'admin'=>$admin, 'model' => $model]);
        删
         $auth = \Yii::$app->authManager;
          $role = $auth->getRole($item_name);
        if ($auth->revoke($role,$user_id)) {
            \Yii::$app->session->setFlash('success',"删除".$user_id."号会员对应".$item_name."角色成功");
            return $this->redirect(['permission/show-admin']);
        }
 //把处理好的一维数组赋值给imgFiles属性
        $model->imgFiles=array_column($goodsImgs,'path');
  ```
- [ ]  菜单管理：
```
设计菜单的数据表
 public function up()
    {
        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->comment('父级分类'),
            'icon' => $this->string()->comment('样式'),
            'url' => $this->string()->comment('路由'),
            'label' => $this->string()->comment('菜单名称'),
            'is_guest' => $this->integer()->defaultValue(1)->comment('是1否0会员'),
        ]);
    }
  public static function menu()
    {
//        声明一个数组用来储存菜单列表
        $newMenus = [];
       $parent = self::find()->where(['parent_id'=>0])->all();
//       遍历父级菜单
        foreach ($parent as $menu) {
            //分别赋值
            $newMenu = [
                'label' => $menu->label,
                'icon' => $menu->icon,
                'url' => '#',
            ];
            //循环当前分类的二级分类
            foreach (self::find()->where(['parent_id' => $menu->id])->all() as $v) {
                //给每个二级分类赋值
                $newMenu['items'][] = [
                    'label' => $v->label,
                    'icon' => $v->icon,
                    'url' => [$v->url]
                ];
            }
            //把一级分类追加到数组中，没循环一次追加一次
            $newMenus[]=$newMenu;
        }
        //返回
        return $newMenus;
        // return self::find()->all();
    }
```
- [ ]  订单管理：
### 2.2.流程

自动登录流程
购物车流程
订单流程
### 2.3.设计要点（数据库和页面交互）
系统前后台设计：前台www.yiishop.com 后台admin.yiishop.com 对url地址美化
商品无限级分类设计：
购物车设计
### 2.4.要点难点及解决方案
难点在于需要掌握实际工作中，如何分析思考业务功能，如何在已有知识积累的前提下搜索并解决实际问题，抓大放小，融会贯通，尤其要排除畏难情绪。
### 3.品牌功能模块
### 3.1.需求
品牌管理功能涉及品牌的列表展示、品牌添加、修改、删除功能。
品牌需要保存缩略图和简介。
品牌删除使用逻辑删除。
### 3.2.流程
### 3.3.设计要点（数据库和页面交互）
### 3.4.要点难点及解决方案
删除使用逻辑删除,只改变status属性,不删除记录
使用uploadify插件,提升用户体验
使用composer下载和安装uploadify
composer安装插件报错,解决办法: composer global require "fxp/composer-asset-plugin:^1.2.0"
注册七牛云账号 安装yii2 七牛云插件
将品牌logo上传到七牛云
#### 4.文章管理模块
### 4.1.需求
文章的增删改查
文章分类的增删改查
###　4.2.设计要点

文章模型和文章详情模型建立1对1关系

### 4.3.要点难点及解决方案

文章分类不能重复,通过添加验证规则unique解决
文章垂直分表,创建表单使用文章模型和文章详情模型
### 5.商品分类

##### 5.1需要

商品分类的增删除改查
无限级分类
列表展示页需要折叠
##### 5.2设计要点

利用ztree展示分类 利用nested实现左值右值

##### 5.3.要点难点及解决方案

ztree插件 进入页面就要展开 点击分类后Js控制value
nested 不能用detelte去删除root节点,要用内置的deleteWithChildren()去删除
健壮性的的时候不能放到自己的子孙节点,这个需要异常捕获
JS字符串比较 lft>clft 改成lft-clft>0
### 6商品管理

### 6.1需要

* 商品的增删除改查
* 商品要有货号
* 每天商品数的统计
* 商品详情
* 分类和品牌
* 多图片
* 列表页需要搜索
### 5.2设计要点

如果货号有输入,则取输入的,如果没有输入自动生成:2017111200001(00001为当天添加的商品总数)
商品详情1对1对 品牌1对1 分类1对1
利用ueditor插件实现富文本编辑器
利用webuploader插件实现多图片上传
图片存储采用七牛OOS云存储
### 5.3.要点难点及解决方案

货号生成: 0000."当天商品数量+1" 再截取后面5位
Ueditor图片上传在本地 到时用 镜像存储解决
多图片回显,把图片地址以数组赋值给属性,多图上传个别失败,需要调整上传到的文件名(key)
列表货号搜索(难点)
删除顺序,要先删除关联的表的数据
多图片上传属性不能和数据库里有的字段一致
## 7.管理员

#### 7.1需要

管理员的增删改查
管理员登录 自动登录
退出
自己资料修改
编辑的时候密码不要回显,如果没有输入密码,不更改,只有输入了密码才更改密码(场景)
#### 7.2设计要点

自动登录
7.3.要点难点及解决方案

要修改配置里user组件里用来实现用户的类 Admin::className();
自己登录要实现接口
自己的资料修改
一般情况下都用username做为用户名字段
8.RBAC权限管理

8.1 需求

权限的增删改查
8.2 设计要点

配置authManager 组件
数据迁移
实例化authManager,再做增删改查
8.3.要点难点及解决方案

权限用过滤器来实现,需要设置全局注入
编辑角色,需要先删除原来所有权限,再执行添加操作
9.菜单管理

9.1需求

菜单的增删改查
两级菜单
9.2 设计要点

无限级菜单

9.3.要点难点及解决方案

循环第一级菜单(parent_id=0),再根据当前的id循环出来它的子类(parent_id=id)
10.前台会员功能

10.1需求

会员注册
会员登录
地址管理
10.2设计要点

会员注册要短信验证
会员登录要实现自动登录
提示用layer插件来做
10.3要点难点及解决方案

阿里大鱼已和阿里云合并,只能用阿里云的包
短信验证存Session Tel_13899996666=>985412
登录后要把Cookie里购物车数据同步到数据库中,同时清空本地购物车数据
验证码只能验证一次,save(false)
11.分类 列表 详情

11.1需求

实现三级分类在头部显示
实现当前分类及子分类所有商品的数据(status=1)显示在列表页
实现商品详情页
11.2设计要点

分类实现缓存技术
采用widget小挂件
利用放大镜技术提升用户体验
11.3 要点难点及解决方案

缓存 设置过期时间,后台添加分类之后要清空缓存
分类 在模型中设置一个得到当前子类的方法
子分类拼接 利用左值和右值当前树来处理 array_column()
取商品要加status
12.购物车

12.1需求

实现购物车功能
12.2设计要点

登录或未登录分别存储
用户登录之后会同步购物车数据
12.3要点难点及解决方案

把逻辑搞清,不清楚画流程图
把购物车逻辑封装成组件
13 订单

13.1需要


