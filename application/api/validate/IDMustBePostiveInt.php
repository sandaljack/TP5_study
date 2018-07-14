<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/6/30
 * Time: 15:53
 */

namespace app\api\validate;

use think\Validate;

class IDMustBePostiveInt extends BaseValidate
{
    protected  $rule = [
        'id'  =>  'require|isPostiveInteger',
    ];

    protected  $message = [
        'id' => 'id参数必须是正整数'
    ];
}