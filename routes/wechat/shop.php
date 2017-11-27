<?php
//用户授权
Route::get('/', 'IndexController@index');

Route::group(['prefix' => 'product'], function () {
    //商品分类
    Route::get('category', 'ProductController@category');
    //搜索页面
    Route::get('search', 'ProductController@search');
    //详情
    Route::get('{id}', 'ProductController@show');
    //搜索完成页面
    Route::get('/', 'ProductController@index');
});

//购物车
Route::group(['prefix' => 'cart'], function () {
    Route::post('/', 'CartController@store');
    Route::get('/', 'CartController@index');
    Route::delete('/', 'CartController@destroy');
    Route::patch('/', 'CartController@change_num');
    Route::patch('delete', 'CartController@delete');
    Route::patch('del', 'CartController@del');
});

//订单
Route::group(['prefix' => 'order'], function () {
    //下单
    Route::get('checkout', 'OrderController@checkout');
    //支付
    Route::patch('update', 'OrderController@update');
    //生成订单支付
    Route::post('store', 'OrderController@store');
    Route::get('pay/{id}', 'OrderController@pay');

    //确认收货
    Route::patch('edit/{id}', 'OrderController@edit');


    //我的订单
    Route::get('show/{id}', 'OrderController@show');
    //删除订单
    Route::delete('destroy/{id}', 'OrderController@destroy');
    //首页
    Route::get('/', 'OrderController@index');
});

//我的
Route::group(['prefix' => 'customer'], function () {
    Route::get('/', 'CustomerController@index');
});


//地址
Route::group(['prefix' => 'address'], function () {
    Route::patch('/', 'AddressController@default_address');
    Route::get('manage', 'AddressController@manage');
});
Route::resource('address', 'AddressController');