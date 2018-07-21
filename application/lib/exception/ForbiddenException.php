<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/21
 * Time: 21:19
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}