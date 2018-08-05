<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/8/5
 * Time: 14:27
 */

namespace app\api\validate;


class AppTokenGet extends  BaseValidate
{
    protected $rule = [
        'ac' => 'require|isNotEmpty',
        'se' => 'require|isNotEmpty'
    ];
}