<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/6/30
 * Time: 18:32
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
    //HTTP 状态吗 200 404
    public $code = 400;
    //错误具体信息
    public $msg = '参数错误';
    //自定义错误码
    public $errorCode = 10000;

}