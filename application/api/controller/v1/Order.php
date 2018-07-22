<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/22
 * Time: 14:38
 */

namespace app\api\controller\v1;


use app\api\validate\OrderPlace;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Controller;
use app\api\service\Token as TokenService;

class Order extends BaseController
{
    //用户在选择商品后，向api提交包含它所选择商品的相关信息
    //API在接收信息后，需要检查订单香港商品的库存量
    //有库存，把订单数据存入数据库中，下单成功，返回客户端消息，告诉客户端可以支付了
    //调用我们的支付接口，进行支付
    //还需要再次进行库存量检测
    //服务器这边就可以调用微信的支付接口进行支付
    //微信会返回给我们一个支付的结果（异步）
    //成功：也需要进行库存量的检测
    //成功：进行库存量的扣除,失败：返回一个失败的结果

    //前置操作
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only'=> 'placeorder']
    ];


    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');//后面加/a才能拿到数组参数
        $uid = TokenService::getCurrentUid();

    }
}