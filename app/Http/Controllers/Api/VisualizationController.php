<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Cache;
use App\Models\Shop\Order;
use App\Models\Shop\OrderProduct;

class VisualizationController extends Controller
{

    function __construct()
    {
        $this->week_start = mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y"));
        $this->week_end = mktime(23, 59, 59, date("m"), date("d") - date("w") + 7, date("Y"));

        $this->month_start = mktime(0, 0, 0, date("m"), 1, date("Y"));
        $this->month_end = mktime(23, 59, 59, date("m"), date("t"), date("Y"));
    }

    //统计男女
    function sex_count()
    {
        $male = User::where('sex', '1')->where('is_show', 0)->count();
        $female = User::where('sex', '2')->where('is_show', 0)->count();
        return collect(compact('male', 'female'));
    }

    //地区
    function customer_province()
    {
        $count = User::select(DB::raw('province as name, count(*) as value'))->groupBy('province')->get();
        return $count;
    }

    //本周订单数
    function sales_count()
    {
        return Cache::remember('xApi_visualization_sales_count', 60, function () {
            $count = [];
            for ($i = 0; $i < 7; $i++) {
                $start = date('Y-m-d H:i:s', strtotime("+" . $i . " day", $this->week_start));
                $end = date('Y-m-d H:i:s', strtotime("+" . ($i + 1) . " day", $this->week_start));

                //待支付
                $count['create'][] = Order::whereBetween('created_at', [$start, $end])->where('status', 1)->count();

                $count['pay'][] = Order::whereBetween('pay_time', [$start, $end])->where('status', 2)->count();

                $count['picking'][] = Order::whereBetween('picking_time', [$start, $end])->where('status', 3)->count();

                $count['shipping'][] = Order::whereBetween('shipping_time', [$start, $end])->where('status', 4)->count();

                $count['finish'][] = Order::whereBetween('finish_time', [$start, $end])->where('status', 5)->count();
            }

            $data = [
                'week_start' => date("Y年m月d日", $this->week_start),
                'week_end' => date("Y年m月d日", $this->week_end),
                'count' => $count,
            ];
            return $data;
        });
    }

    //本周销售额
    function sales_amount()
    {
        return Cache::remember('xApi_visualization_sales_amount', 60, function () {
            $amount = [];
            for ($i = 0; $i < 7; $i++) {
                $start = date('Y-m-d H:i:s', strtotime("+" . $i . " day", $this->week_start));
                $end = date('Y-m-d H:i:s', strtotime("+" . ($i + 1) . " day", $this->week_start));
                $amount['create'][] = Order::whereBetween('created_at', [$start, $end])->where('status', 1)->sum('total_price');
                $amount['pay'][] = Order::whereBetween('pay_time', [$start, $end])->where('status', '>', 1)->sum('total_price');
            }

            $data = [
                'week_start' => date("Y年m月d日", $this->week_start),
                'week_end' => date("Y年m月d日", $this->week_end),
                'amount' => $amount,
            ];
            return $data;
        });
    }

    //本月销量top
    function top()
    {
        return Cache::remember('xApi_visualization_top', 60, function () {
//            DB::enableQueryLog();
            $start = date("Y-m-d H:i:s", $this->month_start);
            $end = date("Y-m-d H:i:s", $this->month_end);

            //本月订单的id
            $order = Order::whereBetween('created_at', [$start, $end])->pluck('id');

            //对应热门商品,前10名. 语句较复杂,请自己return sql出来看
            $products = OrderProduct::with('product')
                ->select('product_id', DB::raw('sum(num) as sum_num'))
                ->whereIn('order_id', $order)
                ->groupBy('product_id')
                ->orderBy(DB::raw('sum(num)'), 'desc')
                ->take(5)
                ->get();


            // return DB::getQueryLog();

            $data = [
                'month_start' => date("Y年m月d日", $this->month_start),
                'month_end' => date("Y年m月d日", $this->month_end),
                'products' => $products,
            ];
            return $data;
        });
    }
}
