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
    //定义表
    protected $table =  'banner';

    //隐藏字段
    protected $hidden = [
        'update_time'
    ];

    //关联banneritem模型
    public function items()
    {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    public static function getBannerById($id)
    {
        $result = self::with(['items', 'items.img'])->find($id);

        return $result;
    }
}