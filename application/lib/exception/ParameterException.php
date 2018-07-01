<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/1
 * Time: 10:41
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}