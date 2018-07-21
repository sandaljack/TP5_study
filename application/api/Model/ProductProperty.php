<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/21
 * Time: 15:46
 */

namespace app\api\Model;


class ProductProperty extends BaseModel
{
    protected $hidden = ['product_id', 'delete_time', 'id'];
}