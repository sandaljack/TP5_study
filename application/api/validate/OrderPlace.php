<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/22
 * Time: 15:29
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{
    protected $oProducts = [
        ['product_id'=>1,'count'=>3],
        ['product_id'=>2,'count'=>3],
        ['product_id'=>3,'count'=>3],
    ];

    protected $Products = [
        ['product_id'=>1,'count'=>3],
        ['product_id'=>2,'count'=>3],
        ['product_id'=>3,'count'=>3],
    ];


    protected $rule = [
        'products' => 'checkProducts'
    ];

    protected  $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'count' => 'require|isPositiveInteger'
    ];

    //验证商品
    protected function checkProducts($values)
    {
        if (!is_array($values)) {
            throw new ParameterException([
                'msg' => '商品参数不正确'
            ]);
        }
        if (empty($values)) {
            throw new ParameterException([
                'msg' => '商品列表不能为空'
            ]);
        }
        foreach ($values as $value) {
            $this->checkProduct($value);
        }
        return true;
    }

    protected function checkProduct($value)
    {
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if (!$result) {
            throw new ParameterException([
                'msg' => '商品列表参数错误'
            ]);
        }
    }
}