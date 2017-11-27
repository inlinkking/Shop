<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Shop\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', session('wechat.user.id'))->get();
        $carts = Cart::with('product')->where('is_show', 1)
            ->where('user_id', session('wechat.user.id'))->get();
        $count = Cart::count_cart($carts);
//        return $cart;
//        return session('wechat.user.address_id');
        return view('wechat.cart.index', compact('cart', 'count'));
    }

    function store(Request $request)
    {
//        return $request->all();
        //判断购物车是否有当前商品,如果有,那么 num +1
        $product_id = $request->product_id;
        $cart = Cart::where('product_id', $product_id)->where('user_id', session('wechat.user.id'))->first();
//        return $cart;
        if ($cart) {
            Cart::where('id', $cart->id)->increment('num');
            return;
        }


        //否则购物车表,创建新数据
        Cart::create([
            'product_id' => $request->product_id,
            'user_id' => session('wechat.user.id'),
        ]);
    }

    public function delete(Request $request)
    {
//        $carts = Cart::with('product')->where('user_id', session('wechat.user.id'))
//            ->where('id', $request->id)->first();
        $cart = Cart::find($request->id);
//        $count = Cart::count_cart();
//        return $count;
        $cart->is_show = 0;
        $cart->save();
        return Cart::count_cart();
    }

    public function del(Request $request)
    {
        $cart = Cart::find($request->id);
//        $order = Cart::count_cart();
//        return $order;
        $cart->is_show = 1;
        $cart->save();
        return Cart::count_cart();
    }

    public function destroy(Request $request)
    {
//        $id = $request->id;
//        Cart::destroy($id);
        Cart::where('id', $request->id)->forceDelete();
        return Cart::count_cart();
    }

    public function change_num(Request $request)
    {
        if ($request->type == 'add') {
            Cart::where('id', $request->id)->increment('num');
        } else {
            Cart::where('id', $request->id)->decrement('num');

        }
        return Cart::count_cart();

//        $id = $request->id;
//        if ($request->type == 'add') {
//            Cart::where('id', $id)->increment('num');
//            $count = Cart::count_cart($id);
//            return $count;
//        } elseif ($request->type == 'sub') {
//            Cart::where('id', $id)->decrement('num');
//            $count = Cart::count_cart($id);
//            return $count;
//        } else {
//            $count = Cart::count_cart($id);
//            return $count;
//        }
    }
}
