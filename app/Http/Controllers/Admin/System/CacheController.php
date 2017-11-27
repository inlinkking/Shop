<?php

namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;

class CacheController extends Controller
{
    public function index()
    {
        return view('admin.system.cache.index');
    }

    //清除缓存
    public function cache()
    {
        Cache::flush();
        return back()->with('success', '清除成功');
    }
}
