<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Wechat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $original = session('wechat.oauth_user.original');
//            dump($original);exit;

        $openid = $original['openid'];
        $user = User::where('openid', $openid)->first();
//        return $user;
        if ($user) {
            $user->update($original);
        } else {
            User::create($original);
        }

        session(['wechat.user' => $user]);

//        if (!session('wechat.user')) {
//            $user = User::where('is_show', 0)->find(64);
//            session(['wechat.user' => $user]);
//        }
        return $next($request);
    }
}
