<?php
/**
 * Created by PhpStorm.
 * User: xieqi
 * Date: 2017/9/6
 * Time: 22:29
 */
Route::group(['prefix' => 'wechat', 'namespace' => 'Wechat', 'as' => 'wechat.'], function () {
    //品牌管理
    Route::group(['prefix' => 'menu'], function () {
        Route::get('edit', 'MenuController@edit')->name('menu.edit');//页面
        Route::put('update', 'MenuController@update')->name('menu.update');//更新
        Route::delete('destroy', 'MenuController@destroy')->name('menu.destroy');//删除
    });
});