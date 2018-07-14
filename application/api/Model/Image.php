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
    protected $hidden = ['delete_time', 'id', 'from', 'update_time'];

    public function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }
}