<?php

namespace App\Http\Controllers\Admin\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Order;
use Carbon;
use App\Models\Shop\Express;

class OrderController extends Controller
{
    public function __construct()
    {
        view()->share('order_status', config('admin.order_status'));
    }

    public function index(Request $request)
    {
//        return $request->all();
        $where = function ($query) use ($request) {
            if ($request->has('id') and $request->id != '') {
                $query->where('id', $request->id);
            }
            if ($request->has('user_id') and $request->user_id != '') {
                $query->where('user_id', $request->user_id);
            }
            if ($request->has('total_price') and $request->total_price != '') {
                $status = is_numeric($request->total_price) ? '=' : substr($request->total_price, 0, 1);
                $total_price = substr($request->total_price, 1);
                switch ($status) {
                    case '>':
                        $query->where('total_price', '<=', $total_price);
                        break;
                    case '<':
                        $query->where('total_price', '>=', $total_price);
                        break;
                    //用户直接输入金额
                    default:
                        $query->where('total_price', $request->total_price);
                }
            }
            if ($request->has('status') and $request->status != '-1') {
                $query->where('status', $request->status);
            }
            if ($request->has('create_at') and $request->create_at != '') {
                $time = explode("~", $request->input('create_at'));
                $start_time = $time[0] . ' 00:00:00';
                $end_time = $time[1] . ' 23:59:59';
                $query->whereBetween('create_at', [$start_time, $end_time]);
            }
        };
//        return $where;
        $orders = Order::with('order_products.product', 'user', 'address')->where($where)
            ->orderBY('created_at', 'desc')->paginate(env('pageSize'));
//        return $orders;
        return view('admin.shop.order.index', compact('orders'));
    }

    public function show($id)
    {
        $expresses = Express::orderBY('sort_order')->get();
        $order = Order::with('address', 'express', 'user', 'order_products.product')->find($id);
//        return $order;
        return view('admin.shop.order.show', compact('expresses', 'order'));
    }

    /**
     * 更新状态：代发货
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->express_code = $request->express_code;
        if ($order->status == 1) {
            $order->status = 2;
        }
        $order->save();
        return back()->with('success', '付款成功');
    }

    /**
     * 更改状态：配货
     * @param Request $request
     */
    public function picking(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 3;
        $order->picking_time = Carbon\Carbon::now();
        $order->save();
    }

    /**
     * 更改状态：出库
     * @param Request $request
     */
    public function shipping(Request $request)
    {
        $order = Order::find($request->id);
        if ($request->status == 3) {
            $order->status = 4;
            $order->shipping_time = Carbon\Carbon::now();
        }
        $order->express_code = $request->express_code;
        $order->express_id = $request->express_id;
        $order->save();
    }

    /**
     * 更改状态：交易成功
     * @param Request $request
     * @return mixed
     */
    public function finish(Request $request)
    {
//        return $request->all();
        $order = Order::find($request->id);
        $order->status = 5;
        $order->finish_time = Carbon\Carbon::now();
        $order->save();
//        return $order;
    }
}
