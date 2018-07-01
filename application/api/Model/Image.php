<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/1
 * Time: 17:15
 */

namespace app\api\Model;


use think\Model;

class Image extends BaseModel
{
    //读取器
    protected function getUrlAttr($value, $data)//$data是数组
    {
        return $this->prefixImgUrl($value, $data);
    }
}