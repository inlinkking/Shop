{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: xieqi--}}
{{--* Date: 2017/9/7--}}
{{--* Time: 12:34--}}
{{--*/--}}
<header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">
        <strong>my-xieqing</strong>
        <small style="margin-left: 30px;">Shop 商城</small>
    </div>
    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:void(0);">
                    <span class="am-icon-users"></span> {{Auth::user()->name}}管理员 <span
                            class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                    <li style="border-bottom:1px solid;margin-top: 5px;"><a href="{{route('system.cache.store')}}"
                                                                            data-method="delete"
                                                                            data-token="{{csrf_token()}}"
                                                                            data-confirm="确认清除吗?"><span
                                    class="am-icon-refresh am-icon-spin"></span> 清除缓存</a></li>
                    <li style="border-bottom:1px solid;margin-top: 5px;"><a
                                href="{{route('system.modify.index')}}"><span class="am-icon-cog"></span>
                            修改密码</a></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                            <span class="am-icon-power-off"></span>
                            退出登陆</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            <li class="am-hide-sm-only"><a href="javascript:void(0);" id="admin-fullscreen"><span
                            class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
        </ul>
    </div>
</header>