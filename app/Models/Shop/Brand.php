<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];

    //一个品牌有多个商品
    public function product()
    {
        return $this->hasMany('App\Models\Shop\Product');
    }

    //检查当前品牌下是否有商品
    public function check_products($id)
    {
        $brand = self::with('products')->find($id);
        if ($brand->products->isEmpty()) {
            return true;
        }
        return false;
    }
}
