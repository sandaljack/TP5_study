<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/22
 * Time: 21:04
 */

namespace app\api\Model;


class Order extends BaseModel
{
    protected $hidden = ['user_id','delete_time','update_time'];
}