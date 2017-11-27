<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    //性别统计
    Route::get('sex_count', 'VisualizationController@sex_count');
    //会员省份统计
    Route::get('customer_province', 'VisualizationController@customer_province');
    //本周订单统计
    Route::get('sales_count', 'VisualizationController@sales_count');
    //本周销售额
    Route::get('sales_amount', 'VisualizationController@sales_amount');
    //本月销量TOP
    Route::get('top', 'VisualizationController@top');

    //广告
    Route::get('ad', 'VueController@ad');
});
//微信接入
Route::group(['namespace' => 'Wechat'], function () {
    Route::any('/wechat', 'WechatController@serve');
});
