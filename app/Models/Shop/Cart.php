<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{

    protected $guarded = [];


    public function product()
    {
        return $this->belongsTo('App\Models\Shop\Product');
    }

    /**
     * 计算购物车总价
     */
    static function count_cart($cart = null)
    {
        $count = [];
        //避免重复查询数据
        $carts = $cart ? $cart : Cart::with('product')->where('is_show', 1)
            ->where('user_id', session('wechat.user.id'))->get();
        $total_price = 0;
        $num = 0;
        foreach ($carts as $v) {
            $total_price += $v->product->price * $v->num;
            $num += $v->num;
        }

        $count['total_price'] = $total_price;
        $count['num'] = $num;

        return $count;

//        $carts = self::with('product')->where('id', $id)->get();
//        $count = ['num' => 0, 'total_price' => 0];
//        foreach ($carts as $value) {
//            $count['num'] += $value->num;
//            $count['total_price'] += $value->total_price * $value->num;
//        }
//        return $count;

    }
}
