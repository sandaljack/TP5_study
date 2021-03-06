<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
//动态版本调用
//轮播图
Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner');

//主题
Route::get('api/:version/theme', 'api/:version.Theme/getSimpleList');

Route::get('api/:version/theme/:id', 'api/:version.Theme/getComplexOne');

//路由分组
Route::group('api/:version/product', function(){
    Route::get('recent', 'api/:version.Product/getRecent');
    Route::get('by_category/:id', 'api/:version.Product/getAllIncategory');
    Route::get(':id', 'api/:version.Product/getOne',[],['id'=>'\d+']);//必须id是正整数
});

//分类
Route::get('api/:version/category/all', 'api/:version.Category/getAllCategories');

//获取token
Route::post('api/:version/token/user', 'api/:version.Token/getToken');
Route::post('api/:version/token/verify', 'api/:version.Token/verifyToken');
Route::post('api/:version/token/app', 'api/:version.Token/getAppToken');



//地址
Route::post('api/:version/address', 'api/:version.Address/createOrUpdateAddress');
Route::get('api/:version/address', 'api/:version.Address/getUserAddress');


//订单
Route::post('api/:version/order', 'api/:version.Order/placeOrder');
Route::get('api/:version/order/:id', 'api/:version.Order/getDetail', [], ['id'=>'\d+']);//获取订单列表
Route::get('api/:version/order/by_user', 'api/:version.Order/getSummaryByUser');//获取订单详情
Route::get('api/:version/order/paginate', 'api/:version.Order/getSummary');//获取订单分页
Route::put('api/:version/order/delivery', 'api/:version.Order/delivery');//获取订单分页





//支付
Route::post('api/:version/pay/pre_order', 'api/:version.Pay/getPreOrder');

//支付回调通知
Route::post('api/:version/pay/notify', 'api/:version.Pay/receiveNotify');
Route::post('api/:version/pay/re_notify', 'api/:version.Pay/redirectNotify');//转发接口 用于调试










