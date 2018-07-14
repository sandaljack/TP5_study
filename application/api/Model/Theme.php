<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/14
 * Time: 12:04
 */

namespace app\api\Model;


class Theme extends BaseModel
{
    protected  $hidden = ['topic_img_id','delete_time','head_img_id','update_time'];
    //关联模型  一对一
    public function topicImg()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

    public function headImg()
    {
        return $this->belongsTo('Image', 'head_img_id', 'id');
    }
}