<?php
/**
 * Created by PhpStorm.
 * User: xieqi
 * Date: 2017/9/6
 * Time: 22:29
 */
Route::group(['prefix' => 'shop', 'namespace' => 'Shop', 'as' => 'shop.'], function () {
    //品牌管理
    Route::group(['prefix' => 'brand'], function () {
        Route::patch('sort_order', 'BrandController@sort_order')->name('brand.sort_order');//排序
        Route::patch('change_attr', 'BrandController@change_attr')->name('brand.change_attr');//显示隐藏
    });
    Route::resource('brand', 'BrandController');//资源控制器

    //分类
    Route::group(['prefix' => 'category'], function () {
        Route::patch('sort_order', 'CategoryController@sort_order')->name('category.sort_order');//排序
        Route::patch('change_attr', 'CategoryController@change_attr')->name('category.change_attr');//显示隐藏
    });
    Route::resource('category', 'CategoryController');//资源控制器

    //会员管理
    Route::group(['prefix' => 'customer'], function () {
        Route::get('index', 'CustomerController@index')->name('customer.index');
    });


    //商品管理
    Route::group(['prefix' => 'product'], function () {
        Route::patch('change_attr', 'ProductController@change_attr')->name('product.change_attr');//改变属性
        Route::patch('stock', 'ProductController@stock')->name('product.stock');//库存
        Route::delete('destroy_gallery', 'ProductController@destroy_gallery')->name('product.destroy_gallery');//删除图片
        Route::patch('delete', 'ProductController@delete')->name('product.delete');//软删除
    });
    Route::resource('product', 'ProductController');//资源控制器


    //物流运费
    Route::group(['prefix' => 'express'], function () {
        Route::patch('change_attr', 'ExpressController@change_attr')->name('express.change_attr');//改变属性
        Route::patch('sort_order', 'ExpressController@sort_order')->name('express.sort_order');//排序
    });
    Route::resource('express', 'ExpressController');//资源控制器

    //回收站
    Route::group(['prefix' => 'trash'], function () {
        Route::get('index', 'TrashController@index')->name('trash.index');
        Route::patch('del_all', 'TrashController@del_all')->name('trash.del_all');
        Route::patch('del_bin', 'TrashController@del_bin')->name('trash.del_bin');
        Route::delete('delete', 'TrashController@delete')->name('trash.delete');
        Route::delete('delete_all', 'TrashController@delete_all')->name('trash.delete_all');
    });

    //数据统计
    Route::group(['prefix' => 'data'], function () {
        Route::get('index', 'DataController@index')->name('data.index');
    });


    //订单管理
    Route::group(['prefix' => 'order'], function () {
        Route::get('index', 'OrderController@index')->name('order.index');
        Route::get('show/{order}', 'OrderController@show')->name('order.show');
        Route::patch('picking', 'OrderController@picking')->name('order.picking');
        Route::patch('shipping', 'OrderController@shipping')->name('order.shipping');
        Route::patch('finish', 'OrderController@finish')->name('order.finish');
    });
});