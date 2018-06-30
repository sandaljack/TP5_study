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

        $banner = BannerModel::getBannerById($id);
        if (!$banner) {
            throw new BannerMissException();
        }

        return $banner;
    }
}