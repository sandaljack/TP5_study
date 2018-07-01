<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/6/27
 * Time: 0:25
 */

namespace app\api\controller\v1;

use app\api\validate\IDMustBePostiveInt;
use app\api\model\Banner as BannerModel;
use think\Exception;
use app\lib\exception\BannerMissException;

class Banner
{
    /*
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     */
    public function getBanner($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        //关联一个模型
//        $banner = BannerModel::with('items')->find($id);
        //关联多个模型表
//        $banner = BannerModel::with(['items','items1'])->find($id);
        //嵌套关联模型
        $banner = BannerModel::with(['items','items.img'])->find($id);


//        $banner = BannerModel::getBannerById($id);
        if (!$banner) {
            throw new BannerMissException();
        }

        return json($banner);
    }
}