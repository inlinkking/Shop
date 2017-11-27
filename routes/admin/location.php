<?php
/**
 * Created by PhpStorm.
 * User: xieqi
 * Date: 2017/9/6
 * Time: 22:29
 */
Route::group(['prefix' => 'location', 'namespace' => 'Location', 'as' => 'location.'], function () {

    //系统设置
    Route::group(['prefix' => 'map'], function () {
        Route::get('index', 'MapController@index')->name('map.index');//系统设置
    });
});