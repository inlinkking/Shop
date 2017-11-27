<?php

namespace App\Http\Controllers\Wechat;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        view()->share([
            '_customer' => 'on'
        ]);
        $customer = User::find(session('wechat.user.id'));
//        return $customer;
        return view('wechat.customer.index',compact('customer'));
    }
}
