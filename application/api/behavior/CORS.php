<?php
/**
 * Created by PhpStorm.
 * User: lxj
 * Date: 2018/8/5
 * Time: 15:50
 */

namespace app\api\behavior;


class CORS
{
    public function appInit(&$params)
    {
        // 准许跨域请求。
        header("Access-Control-Allow-Origin: * ");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        if(request()->isOptions()){
            exit();
        }
    }
}