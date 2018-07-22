<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/22
 * Time: 18:39
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = 80000;
}