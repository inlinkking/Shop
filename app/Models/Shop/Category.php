<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Category extends Model
{
    protected $guarded = [];

    static function clear()
    {
        Cache::forget('shop_all_categories');
    }

    //一级分类有很多二级分类
    public function children()
    {
        return $this->hasMany('App\Models\Shop\Category', 'parent_id', 'id');
    }

    //检查一级分类下有没有二级分类
    static function check_children($id)
    {
        $category = self::with('children')->find($id);
        if ($category->children->isEmpty()) {
            return true;
        }
        return false;
    }

//查出所有
    static function all_categories()
    {
        $categories = Cache::rememberForever('shop_all_categories', function () {
            return self::with([
                'children' => function ($query) {
                    $query->orderBY('sort_order', 'desc');
                }
            ])->where('parent_id', 0)->orderBY('sort_order', 'desc')->get();
        });
        return $categories;
    }

    //筛选分类时屏蔽掉没有商品的分类
    static function filter_categories()
    {
        $categories = self::has('children.products')->with([
            'children' => function ($query) {
                $query->has('products');
            }
        ])->get();
        return $categories;
    }

    //一个分类有多个商品
    public function products()
    {
        return $this->belongsToMany('App\Models\Shop\Product');
    }

//    检查当前分类下有没有商品
    public function check_products($id)
    {
        $category = self::with('products')->find($id);
        if ($category->products->isEmpty()) {
            return true;
        }
        return false;
    }
}
