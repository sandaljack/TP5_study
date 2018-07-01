<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/6/30
 * Time: 17:34
 */

namespace app\api\Model;


use think\Db;
use think\Exception;
use think\Model;

class Banner extends Model
{
    //定于表
    protected $table =  'banner';
    public static function getBannerById($id)
    {
//        $result = Db::query("select * from banner_item where banner_id=?", [$id]);
//        return $result;
//        $result = Db::table('banner_item')->where('banner_id','=' ,$id)->select();
        //闭包
        $result = Db::table('banner_item')
            ->where(function($query)use ($id){
                $query->where('banner_id', '=', $id);
            })
            ->select();

        return $result;
    }
}