<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/8/5
 * Time: 14:30
 */

namespace app\api\Model;


class ThirdApp extends BaseModel
{
    public static function check($ac, $se)
    {
        $app = self::where('app_id','=',$ac)
            ->where('app_secret', '=',$se)
            ->find();
        return $app;

    }
}