<?php

namespace App\Http\Controllers\Admin\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $where = function ($query) use ($request) {
            if ($request->has('nickname') and $request->nickname != '') {
                $nickname = "%" . $request->nickname . "%";
                $query->where('nickname', 'like', $nickname);
            }
            if ($request->has('openid') and $request->openid != '') {
                $openid = "%" . $request->openid . "%";
                $query->where('openid', 'like', $openid);
            }
            if ($request->has('sex') and $request->sex != '-1') {
                $query->where('sex', $request->sex);
            }
            if ($request->has('create_at') and $request->create_at != '') {
                $time = explode("~", $request->input('create_at'));
                $start_time = $time[0] . ' 00:00:00';
                $end_time = $time[1] . ' 23:59:59';
                $query->whereBetween('create_at', [$start_time, $end_time]);
            }
        };
        $customers = User::where($where)->where('is_show',0)->paginate(env('pageSize'));
        return view('admin.shop.customer.index', compact('customers'));
    }
}
