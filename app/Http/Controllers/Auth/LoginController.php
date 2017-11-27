<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * 多字段登陆
     * @param Request $request
     */
    public function attemptLogin(Request $request)
    {
//        return $request->all();
        $username = $request->input('name');
        $password = $request->input('password');
        //验证用户名登陆
        $usernameLogin = $this->guard()->attempt(
            ['name' => $username, 'password' => $password, 'is_show' => 1], $request->has('remember')
        );
        if ($usernameLogin) {
            return true;
        }
        $emailLogin = $this->guard()->attempt(
            ['email' => $username, 'password' => $password, 'is_show' => 1], $request->has('remember')
        );
        if ($emailLogin) {
            return true;
        }
        $mobileLogin = $this->guard()->attempt(
            ['mobile' => $username, 'password' => $password, 'is_show' => 1], $request->has('remember')
        );
        if ($mobileLogin) {
            return true;
        }
    }

    /**
     * 更改用户名登陆
     */
    public function username()
    {
        return 'name';
    }

    /**
     * 退出
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/admin/login');
    }


    /**
     * 加入验证码验证
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha',
        ]);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
