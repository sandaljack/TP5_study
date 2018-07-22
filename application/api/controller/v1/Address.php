<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/21
 * Time: 17:48
 */

namespace app\api\controller\v1;

use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use think\Controller;

class Address extends BaseController
{
    //前置操作
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only'=> 'createorupdateaddress'] //只有在调用createOrUpdateAddress前需要前置调用checkPrimaryScope
    ];


    //创建和更新地址
    public function  createOrUpdateAddress()
    {
        $validate = new AddressNew();
        $validate->goCheck();
        //根据Token来获取uid
        //根据uid来查找用户数据，判断用户是否存在，如果不存在抛出异常
        //获取用户从客户端提交来的地址信息
        //根据用户地址信息是否存在，从而判断是添加地址还是更新地址
        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if (!$user) {
            throw new UserException();
        }
        $dataArray = $validate->getDataByRule(input('post.'));
        $userAddress = $user->address;
        if (!$userAddress) {
            //新增
            $user->address()->save($dataArray);
        } else {
            //更新
            $user->address->save($dataArray);
        }
        return json(new SuccessMessage(),201);
    }
}