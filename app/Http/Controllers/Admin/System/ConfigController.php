<?php

namespace App\Http\Controllers\Admin\System;

use App\Models\System\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Config::find(1);
        return view('admin.system.config.index', compact('config'));
    }

    public function store(Request $request)
    {

        $config = Config::find(1);
        $config->update($request->all());
        return back()->with('success', '更改成功');
    }
}
