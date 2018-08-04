<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/7/15
 * Time: 17:11
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;
use app\lib\exception\ParameterException;
use app\api\service\Token as TokenService;

class Token
{
    public function getToken($code = '')
    {
        (new TokenGet())->goCheck();
        $userTokenService = new UserToken($code);
        $token = $userTokenService->get();
        return [
            'token' => $token
        ];
    }

    public function verifyToken($token='')
    {
        if(!$token){
            throw new ParameterException([
                'token不允许为空'
            ]);
        }
        $valid = TokenService::verifyToken($token);
        return [
            'isValid' => $valid
        ];
    }
}