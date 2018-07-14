<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/14
 * Time: 21:28
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected  $rule = [
        'count' => 'isPostiveInteger|between:1,15'
    ];
}