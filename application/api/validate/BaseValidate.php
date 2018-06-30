<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/6/30
 * Time: 16:13
 */

namespace app\api\validate;


use think\Exception;
use think\Validate;
use think\Request;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取http传入的参数
        //对参数校验
        $request = Request::instance();
        $params = $request->param();
        $result = $this->check($params);
        if (!$result) {
            $error = $this->error;
            throw new Exception($error);
        } else {
            return true;
        }
    }
}