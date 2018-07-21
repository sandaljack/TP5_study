<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/15
 * Time: 19:55
 */

namespace app\api\Model;


class User extends BaseModel
{
    //关联地址表
    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    public static function getByOpenID($openid)
    {
        $user = self::where('openid', '=', $openid)->find();
        return $user;
    }

}