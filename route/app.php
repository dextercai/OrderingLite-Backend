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
use think\facade\Route;

Route::group('', function () {
    Route::post('Auth/Login', 'Auth/Login');
    Route::post('Auth/TokenCheck', 'Auth/TokenCheck');
    Route::get('Order/TypeList', "Order/typeList");
    Route::post('Order/MenuList', "Order/menuList");
    Route::post('Order/tableInfo', "Order/vaildTable");
    Route::post('Order/commit', "Order/orderCommit");
    Route::post('Order/orderList', "Order/orderList");
});


Route::group('',function (){
    Route::get('User/list', "User/list");
    Route::post('User/update', "User/update");
    Route::post('User/delete', "User/delete");
})->middleware(\app\middleware\AuthCheck::class);

