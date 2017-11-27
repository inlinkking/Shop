<?php

namespace App\Http\Controllers\Admin\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;
use EasyWeChat\Core\Exceptions\HttpException;
use EasyWeChat;


class MenuController extends Controller
{
    private $menu;

    public function __construct()
    {
        $this->menu = EasyWeChat::menu();
    }

    function edit()
    {
        try {
            $buttons = Cache::rememberForever('wechat_config_menus', function () {
                $menus = $this->menu->all();
                return $menus->menu['button'];
            });
        } catch (HttpException $e) {
            $buttons = [];
        }
        return view('admin.wechat.menu.edit', compact('buttons'));
    }

    function update(Request $request)
    {
//        $this->validate($request, [
//            'name' => 'required|unique:menus,name|1',
//            'parent_id' => 'required|1',
//            'url' => 'required|1'
//        ]);
//        return $request->all();
        $buttons = wechat_menus($request->buttons);
//        return $buttons;
        $this->menu->add($buttons);
        Cache::forget('wechat_config_menus');
        return back()->with('success', '您已修改，如果没有反应请取消关注后重新关注');
    }

    function destroy()
    {
        $this->menu->destroy();
        Cache::forget('wechat_config_menus');
        return back()->with('success', '您已删除成功，如果没有反应请取消关注后重新关注');
    }
}
