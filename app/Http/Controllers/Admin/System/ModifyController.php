<?php

namespace App\Http\Controllers\Admin\System;

use APP\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ModifyController extends Controller
{
    public function index()
    {
        return view('admin.system.modify.index');
    }

//修改密码
    public function store(Request $request)
    {
        $name = Auth::user()->name;
        if (Auth::user()->email != $request->email) {
            return back()->with('error', '邮箱不正确');
        }
        if (Auth::user()->mobile != $request->mobile) {
            return back()->with('error', '手机号不正确');
        }
        if (!Auth::attempt(['name' => $name, 'password' => ($request->change_password)])) {
            return back()->with('error', '原始密码不正确');
        }
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);
        User::where('id', Auth::id())->update(['password' => bcrypt($request->password)]);
        Auth::guard()->logout();
        return redirect('/admin/login');
    }
}
