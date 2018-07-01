<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/1
 * Time: 18:28
 */

namespace app\api\Model;


use think\Model;

//基类
class BaseModel extends Model
{
    protected function prefixImgUrl($value, $data)
    {
        $finalUrl = $value;
        //拼接成完成url路径
        if($data['from'] == 1) {
            $finalUrl =  config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}