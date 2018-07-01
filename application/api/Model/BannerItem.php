<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/1
 * Time: 15:40
 */

namespace app\api\Model;


use think\Model;

class BannerItem extends Model
{
    public function img()
    {
        //一对一
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}