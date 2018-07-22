<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/22
 * Time: 15:17
 */

namespace app\api\controller\v1;

use app\api\service\Token as TokenService;
use think\Controller;

class BaseController extends Controller
{
    //检测权限
    protected function checkPrimaryScope()
    {
        TokenService::needPrimaryScope();
    }

    protected function checkExclusiveScope()
    {
        TokenService::needExclusiveScope();
    }
}