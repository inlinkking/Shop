<?php
/**
 * Created by PhpStorm.
 * User: xieqi
 * Date: 2017/9/6
 * Time: 22:29
 */
Route::group(['prefix' => 'system', 'namespace' => 'System', 'as' => 'system.'], function () {

    //系统设置
    Route::group(['prefix' => 'config'], function () {
        Route::get('index', 'ConfigController@index')->name('config.index');//系统设置
        Route::put('store', 'ConfigController@store')->name('config.store');//保存
    });


    //清除缓存
    Route::group(['prefix'=>'cache'],function(){
        Route::get('index', 'CacheController@index')->name('cache.index');//清除缓存页面
        Route::delete('cache', 'CacheController@cache')->name('cache.store');//清除缓存
    });


    //修改密码
    Route::group(['prefix'=>'modify'],function(){
        Route::get('index', 'ModifyController@index')->name('modify.index');//修改密码
        Route::put('store', 'ModifyController@store')->name('modify.store');//保存
    });

    //菜单与权限
    Route::group(['prefix'=>'permission'],function(){
        Route::patch('sort_order','PermissionController@sort_order')->name('permission.sort_order');
    });
    Route::resource('permission', 'PermissionController');//资源控制器

    //用户组管理
    Route::group(['prefix'=>'role'],function(){
    });
    Route::resource('role','RoleController');//资源控制器


    //用户管理
    Route::group(['prefix'=>'user'],function(){
    });
    Route::resource('user','UserController');//资源控制器
});