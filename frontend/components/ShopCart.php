<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/12
 * Time: 13:32
 */

namespace frontend\components;


use frontend\models\Cart;
use yii\base\Component;
use yii\web\Cookie;

class ShopCart extends Component
{
//1.声明一个私有化变量用来储存所有的cookie数据,/查询购物车的所有数据$cart = \Yii::$app->request->cookies->getValue('cart');
    private $_cart=[];
//2.自动执行查询所有的购物车数据
   public function __construct(array $config = [])
   {
//       1.1.1如果存在，给一个空值时是防止得到的时候出错
      $this->_cart = \Yii::$app->request->cookies->getValue('cart',[]);
       parent::__construct($config);
   }
//   执行添加数据
   public function add($id,$amount){
       if(isset($this->_cart[$id])){
//           执行加操作
           $this->_cart[$id] += $amount;
       }else{
           $this->_cart[$id] = $amount;
       }
       return $this;
   }
//   执行修改数据
   public function update($id,$amount){
       $this->_cart[$id] = $amount;
//       返回对象
       return $this;
   }
    //       执行删除数据
   public function del($id){
          unset($this->_cart[$id]);
//          返回对象
          return $this;
   }
//   得到cookie 数据
   public function get(){
       return $this->_cart;
   }
//   写入数据
   public function save(){
       $setCookie = \Yii::$app->response->cookies;
//              2.new cookie 值 实例化
       $newCookie = new Cookie([
           'name'=>'cart',
           'expire' => time() + 3600*24*30,
           'httpOnly' => true,
           'value'=>$this->_cart,
       ]);
//              3.加入cookie中去
       $setCookie->add($newCookie);
       return $this;
   }
//   cookie 入数据库
     public function synDb(){
       foreach ($this->_cart as $k=>$v){
           $cart = Cart::findOne(['member_id'=>\Yii::$app->user->id,'goods_id'=>$k]);
           if($cart){
               $cart->amount +=$v;
           }else{
               $cart = new Cart();
               $cart->amount = $v;
               $cart->goods_id = $k;
               $cart->member_id = \Yii::$app->user->id;
           }
           $cart->save();
       }
//       清空cookie 值
       $this->_cart=[];
         return $this;
     }
//     添加到数据库
     public function addDb($id,$amount){
         $cart = Cart::findOne(['goods_id'=>$id,'member_id'=>\Yii::$app->user->id]);
         if ($cart) {
//                  数据库中存在，执行更改操作
             $cart->amount = $cart->amount+$amount;
         }else{
//                  数据库中不存在，执行写入数据
             $cart = new Cart();
             $cart->amount = $amount;
             $cart->member_id = \Yii::$app->user->id;
             $cart->goods_id = $id;
         }
         $cart->save();
     }
     public function flush(){
         //       清空cookie 值
         $this->_cart=[];
         return $this;
     }
}