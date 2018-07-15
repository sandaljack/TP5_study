<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/6/30
 * Time: 16:13
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
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
        $result = $this->batch()->check($params);
        if (!$result) {
            $e = new ParameterException([
                'msg' => $this->error,
            ]);
            throw $e;
        } else {
            return true;
        }
    }

    protected function isPostiveInteger($value, $rule = '', $data = '', $field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }

    protected function isNotEmpty($value, $rule = '', $data = '', $field = '')
    {
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }
}