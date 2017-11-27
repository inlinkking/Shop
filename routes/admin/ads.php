<?php
/**
 * Created by PhpStorm.
 * User: xieqi
 * Date: 2017/9/6
 * Time: 22:29
 */
Route::group(['prefix' => 'ads', 'namespace' => 'Ads', 'as' => 'ads.'], function () {
    //广告管理
    Route::group(['prefix' => 'ad'], function () {
        Route::patch('sort_order', 'AdController@sort_order')->name('ad.sort_order');//排序
        Route::patch('delete', 'AdController@delete')->name('ad.delete');//移除到回收站
    });
    Route::resource('ad', 'AdController');//资源控制器

    //广告分类
    Route::group(['prefix' => 'ad_category'], function () {
        Route::patch('sort_order', 'Ad_categoryController@sort_order')->name('ad_category.sort_order');//排序
    });
    Route::resource('ad_category', 'Ad_categoryController');//资源控制器


    //广告回收站
    Route::group(['prefix' => 'trash'], function () {
        Route::get('index', 'TrashController@index')->name('trash.index');//页面
        Route::patch('reduction', 'TrashController@reduction')->name('trash.reduction');//还原单挑
        Route::patch('reduction_all', 'TrashController@reduction_all')->name('trash.reduction_all');//还原多条
        Route::delete('delete', 'TrashController@delete')->name('trash.delete');//删除单挑
        Route::delete('delete_all', 'TrashController@delete_all')->name('trash.delete_all');//删除多条
    });
});