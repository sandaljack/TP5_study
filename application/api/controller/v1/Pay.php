<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/28
 * Time: 20:04
 */

namespace app\api\controller\v1;

use app\api\service\Pay as PayService;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePostiveInt;

class Pay extends BaseController
{
    //权限验证  前置方法
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only'=> 'getpreorder']
    ];

    //支付接口
    public function getPreOrder($id)
    {
        (new IDMustBePostiveInt()) -> goCheck();
        $pay = new PayService($id);
        return $pay->pay();
    }

    //回调接口
    public function redirectNotify()
    {
        //通知频率 15/15/30/180/1800/1800/1800/1800/3600,单位:秒

        //1.检查库存量,
        //2.更新订单状态
        //3.减库存
        //4.如果成功处理，我们返回微信成功处理的信息。否则需要返回没有成功的处理

        //特点:post; xml格式；不会携带参数
        $notify = new WxNotify();
        $notify->Handle();
    }

    //转发接口  可以用来回调试
    public function receiveNotify()
    {
        $xmlData = file_get_contents('php://input');
        $result = curl_post_raw('当前地址?XDEBUG_SESSION_START=18383', $xmlData);
    }
}