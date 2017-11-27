<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Ads\Ad;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
//        return session()->all();
        view()->share([
           '_index'=>'on',
        ]);
        $wechat = Ad::where('category_id',8)->get();
        $wechats=Ad::where('category_id',9)->get();
        $product = Product::where('is_recommend',true)->orderBY('is_top','desc')->get();
        return view('wechat.index', compact('wechat','wechats','product'));
    }
}
