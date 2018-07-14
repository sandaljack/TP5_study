<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/14
 * Time: 15:27
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在，请检查主题ID';
    public $errorCode = 30000;
}