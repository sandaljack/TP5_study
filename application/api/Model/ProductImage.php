<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/21
 * Time: 15:42
 */

namespace app\api\Model;


class ProductImage extends BaseModel
{
    protected $hidden = ['img_id', 'delete_time', 'product_id'];

    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}