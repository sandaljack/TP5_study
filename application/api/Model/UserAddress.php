<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/21
 * Time: 18:56
 */

namespace app\api\Model;


class UserAddress extends BaseModel
{
    protected $hidden = ['id', 'delete_time', 'user_id'];
}