<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/6/30
 * Time: 17:34
 */

namespace app\api\Model;


use think\Exception;

class Banner
{
    public static function getBannerById($id)
    {
        //TODO:根据Banner的 ID 号 获取Banner信息
        try{
//            1/0;
        } catch (Exception $ex) {
            //TODO 可以记录日志
            throw $ex;
        }
        return "this is banner info";
    }
}