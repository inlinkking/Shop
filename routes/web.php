<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//微信
Route::group(['namespace' => 'Wechat', 'prefix' => '/','middleware'=>['wechat.oauth','wechat']], function () {
//    Route::group(['middleware' => ['wechat.oauth', 'wechat']], function () {
        require 'wechat/shop.php';
//    });
});

//后台
Route::resource('photos', 'PhotoController', ['only' => ['store']]);
Route::group(['prefix' => 'admin'], function () {
    //登陆
    Auth::routes();
    Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'sidebar', 'role']], function () {
        Route::get('/', 'IndexController@index')->name('admin.index');//主页
        require 'admin/shop.php';//商品
        require 'admin/system.php';//系统
        require 'admin/ads.php';//广告
        require 'admin/wechat.php';//微信
        require 'admin/location.php';//地图
    });
});
