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

//地址
Route::post('api/:version/address', 'api/:version.Address/createOrUpdateAddress');

//订单
Route::post('api/:version/order', 'api/:version.Order/placeOrder');







