<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/6/27
 * Time: 0:25
 */

namespace app\api\controller\v1;


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
        return $id;
    }
}