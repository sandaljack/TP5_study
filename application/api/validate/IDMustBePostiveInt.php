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
        'id'  =>  'require|isPostiveIntterger',
        'num' => 'in:1,2,3'
    ];

    protected function isPostiveIntterger($value, $rule = '', $data = '', $field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return $field.'必须是整数';
        }
    }
}