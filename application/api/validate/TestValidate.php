<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/6/30
 * Time: 14:03
 */

namespace app\api\validate;

use think\Validate;

class TestValidate extends  Validate
{
    protected  $rule = [
        'name' => 'require|max:10',
        'eamil' => 'email'
    ];
}