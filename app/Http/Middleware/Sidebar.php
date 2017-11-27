<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\System\Permission;
use Auth, Gate, Route, Cache;


class Sidebar
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
        $this->menus();
        $this->bibel();
        $this->active_menu();
        return $next($request);
    }


    /**
     * 自动选择菜单
     */
    private function active_menu()
    {
        $label = Route::currentRouteName();
        $parent_menu = $children_menu = '';
        //如果不是后台首页， 首页直接为 ''
        if ($label != 'admin.index') {
            $permission = Permission::with('parent')->where('label', $label)->first();

            //判断当前是二级还是三级
            if ($permission->parent->parent_id == 0) {
                $parent_menu = $permission->parent->label;
                $children_menu = $permission->label;
            } else {
                $parent_menu = $permission->parent->parent->label;
                $children_menu = $permission->parent->label;
            }
        }
        view()->share(compact('parent_menu', 'children_menu'));
    }


    /**
     * 所有菜单
     */
    private function menus()
    {
//        $permissions = Cache::rememberForever('menus_user_'.Auth::user()->id, function () {
//            return  Permission::get_children();
//        });
////        如果是超级管理员，则拥有所有菜单。否则自动获取该用户拥有权限的菜单。
//        $menus = Auth::user()->hasRole('超级管理员') ? $permissions : $this->get_menus($permissions);
//        view()->share('menus', $menus);


        $menus = Cache::rememberForever('menus_user_' . Auth::user()->id, function () {
            $permissions = Permission::get_children();

            //三元判断如果是超级管理员 就 获得所有权限 否则 就获得有限的权限，通过get_menus()方法定义
            return Auth::user()->hasRole('超级管理员') ? $permissions : $this->get_menus($permissions);
        });
        view()->share('menus', $menus);


//        $permissions = Permission::get_children();
//        //如果是超级管理员，则拥有所有菜单。否则自动获取该用户拥有权限的菜单。
//        $menus = Auth::user()->hasRole('超级管理员') ? $permissions : $this->get_menus($permissions);
//        view()->share('menus', $menus);
    }

    private function get_menus($permissions)
    {
        foreach ($permissions as $key => $permission) {
            if (Gate::denies($permission->label)) {
                unset($permissions[$key]);
                continue;
            }
            foreach ($permission->children as $k => $children) {
                if (Gate::denies($children->label)) {
                    unset($permissions[$key]['children'][$k]);
                }
            }
        }
        return $permissions;
    }


    //获取公告
    private function bibel()
    {
        @$bibels = file('bibel.txt');
        $size = count($bibels) / 2 - 1;
        $rand = rand(0, $size) * 2;
        $bibel = array(
            'cn' => $bibels[$rand + 1],
            'en' => $bibels[$rand]
        );
        view()->share('bibel', $bibel);
    }
}
