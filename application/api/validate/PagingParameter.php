<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/29
 * Time: 20:22
 */

namespace app\api\validate;


class PagingParameter extends BaseValidate
{
    protected  $rule = [
        'page' => 'isPositiveInteger',
        'size' => 'isPositiveInteger',
    ];

    protected $message = [
        'page' => '分页参数必须是正整数',
        'size' => '分页参数必须是正整数'
    ];
}