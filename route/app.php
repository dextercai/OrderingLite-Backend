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
    Route::get('Table/list', "Table/list");
    Route::post('Table/update', "Table/update");
    Route::post('Table/delete', "Table/delete");
    Route::get('Session/list', "Session/list");
    Route::get('Session/ret', "Session/ret");
    Route::post('Session/start', "Session/start");
    Route::get('Kitchen/alllist', "Kitchen/alllist");
    Route::get('Kitchen/prelist', "Kitchen/prelist");
    Route::get('Kitchen/donelist', "Kitchen/donelist");
    Route::post('Kitchen/toPre', "Kitchen/toPre");

    Route::get('Dish/list', "Dish/list");
    Route::post('Dish/update', "Dish/update");
    Route::post('Dish/delete', "Dish/delete");

    Route::get('Stat/now', "Stat/now");
    Route::get('Stat/dish', "Stat/dish");

})->middleware(\app\middleware\AuthCheck::class);

