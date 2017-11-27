<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = ['category_id', 'imgs', 'file'];
    //关联
    //每个商品属于某个品牌
    public function brand()
    {
        return $this->belongsTo('App\Models\Shop\Brand');
    }

    //商品可以属于多个分类
    public function categories()
    {
        return $this->belongsToMany('App\Models\Shop\Category');
    }

//一个商品有很多相册图片
    public function product_galleries()
    {
        return $this->hasMany('App\Models\Shop\ProductGallery');
    }

    public function order_products()
    {
        return $this->hasMany('App\Models\Shop\OrderProduct');
    }

    //检查当前商品有没有订单
    static function check_orders($id)
    {
        $product = self::with('order_products')->find($id);
        if ($product->order_products->isEmpty()) {
            return true;
        }
        return false;
    }
}
