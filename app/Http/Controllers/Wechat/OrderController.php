<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Shop\Address;
use App\Models\Shop\Cart;
use App\Models\Shop\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use App\Models\Shop\OrderProduct;
use App\Models\Shop\OrderAddress;
use EasyWeChat\Payment\Order as WechatOrder;
use EasyWeChat, Carbon;

class OrderController extends Controller
{

    //我的订单
    public function index(Request $request)
    {
        $where = function ($query) use ($request) {
            $query->where('user_id', session('wechat.user.id'));

            switch ($request->status) {
                case '':
                    break;
                case  '1':
                    $query->where('status', 1);
                    break;
                case  '2':
                    $query->where('status', [2, 3, 4]);
                    break;
            }
        };
        $order_status = config('admin.order_status');
        $orders = Order::where($where)->with('order_products.product', 'user', 'address')
            ->orderBY('status', 2)->orderBY('created_at', 'desc')->get();
        return view('wechat.order.index', compact('orders', 'order_status'));
    }

    /**
     * 下单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout()
    {
//        return $id;
        $carts = Cart::with('product')->where('is_show', 1)
            ->where('user_id', session('wechat.user.id'))->get();
//        return $carts;
        $count = Cart::count_cart($carts);
        if ($carts->isEmpty()) {
            return redirect('/cart');
        }
        $address = Address::find(session('wechat.user.address_id'));
//        return $address;

        return view('wechat.order.checkout', compact('carts', 'count', 'address'));
    }


    public function show($id)
    {
        $order = Order::with('address', 'express', 'user', 'order_products.product')->find($id);
        return view('wechat.order.show', compact('order'));
    }

    public function store(Request $request)
    {
//        return $request->all();
        $carts = Cart::with('product')->where('is_show', 1)
            ->where('user_id', session('wechat.user.id'))->get();
        //防止用户使用微信的后退按钮，重新提交订单，导致出现没有数据的订单
        if ($carts->isEmpty()) {
            return ['status' => 0, 'info' => ''];
        }
        $count = Cart::count_cart();
        $total_price = $count['total_price'];
        \DB::beginTransaction();
        try {
            //生成订单
            $order = Order::create([
                'user_id' => session('wechat.user.id'),
                'total_price' => $total_price,
                'status' => 1,
                'pay_type' => $request->pay
            ]);
            //订单地址
            $address = Address::find($request->address_id);
            $order->address()->create([
                'province' => $address['province'],
                'city' => $address['city'],
                'area' => $address['area'],
                'name' => $address['name'],
                'tel' => $address['tel'],
                'address' => $address['address'],
            ]);
            $carts = Cart::with('product')->where('is_show', 1)
                ->where('user_id', session('wechat.user.id'))->get();
            foreach ($carts as $cart) {
                //判断库存是否足够
                if ($cart->product->stock != '-1' and $cart->product->stock - $cart->num < 0) {
                    throw new \Exception('商品' . $cart->product->name .
                        '， 目前仅剩下' . $cart->product->stock . "件。\n请返回购物车，修改订单后再下单");
                }
                //削减库存数量
                if ($cart->product->stock != '-1') {
                    $cart->product->decrement('stock', $cart->num);
                }
                //插入订单商表
                $order->order_products()->create([
                    'product_id' => $cart->product_id,
                    'num' => $cart->num,
                ]);
            }
            //清空购物车
            Cart::with('product')->where('is_show', 1)
                ->where('user_id', session('wechat.user.id'))->delete();
        } catch (\Exception $e) {
//            echo $e->getMessage();
            \DB::rollback();
            return ['status' => 0, 'info' => $e->getMessage()];
        }
        \DB::commit();
        return ['status' => 1, 'info' => $order->id];
    }

    public function destroy($id)
    {
        //查出对应商品
        $order = Order::with('order_products')->find($id);
        foreach ($order->order_products as $order_product) {
            $product = Product::find($order_product->product_id);
            //如果不是无限库存
            if ($product->stock != '-1') {
                Product::where('id', $order_product->product_id)->increment('stock', $order_product->num);
            }
        }
        //删除订单商品
        OrderProduct::where('order_id', $id)->delete();
        //删除订单地址
        OrderAddress::where('order_id', $id)->delete();
        Order::destroy($id);
//        return back();
    }

    public function update(Request $request)
    {
        $order = Order::find($request->id);
        $order->pay_time = Carbon\Carbon::now();
        $order->status = 2;
        $order->pay_type = $request->pay;
        $order->save();
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $order->status = 5;
        $order->finish_time = Carbon\Carbon::now();
        $order->save();
    }

    public function pay($id)
    {
        $order = Order::with('address')->find($id);
        return view('wechat.order.show_pay', compact('order'));
    }
}
