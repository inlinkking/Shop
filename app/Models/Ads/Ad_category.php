<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Ad_category extends Model
{
    protected $guarded = [];
    protected $table = 'ad_categories';

    //清除缓存
    static function clear()
    {
        Cache::forget('Ad_ads_categories');
    }

    public function ads()
    {
        return $this->hasMany('App\Models\Ads\Ad');
    }

    /**
     * 生成分类数据
     * @return mixed
     */
    static function get_categories()
    {
        $categories = Cache::rememberForever('Ad_ads_categories', function () {
            return self::orderBy('sort_order', 'desc')->get();
        });
        return $categories;
    }

    /**
     * 检查是否有广告
     * @param $id
     * @return bool
     */
    static function check_ads($id)
    {
        $category = self::with('ads')->find($id);
        if ($category->ads->isEmpty()) {
            return true;
        }
        return false;
    }
}
