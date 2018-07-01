<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/1
 * Time: 17:15
 */

namespace app\api\Model;


use think\Model;

class Image extends Model
{
    //读取器
    protected function getUrlAttr($value, $data)//$data是数组
    {
        $finalUrl = $value;
        //拼接成完成url路径
        if($data['from'] == 1) {
            $finalUrl =  config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}