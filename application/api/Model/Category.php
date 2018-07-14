<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/15
 * Time: 0:54
 */

namespace app\api\Model;


class Category extends BaseModel
{
    protected $hidden = ['delete_time', 'update_time', 'create_time'];

    public function Img()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }
}