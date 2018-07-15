<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/15
 * Time: 17:27
 */

namespace app\api\validate;


class TokenGet extends  BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];

    protected  $message = [
        'code' => '没有code，获取token失败'
    ];
}