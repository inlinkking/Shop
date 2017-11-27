{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: xieqi--}}
{{--* Date: 2017/9/7--}}
{{--* Time: 12:35--}}
{{--*/--}}
<div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
        <ul class="am-list admin-sidebar-list">
            <li>
                <a href="/admin" class="{{ $parent_menu == '' ? 'am-active' : ''}}">
                    <span class="am-icon-home"></span> 首页
                </a>
            </li>
            @foreach($menus as $menu)
                <li class="admin-parent">
                    <a class="am-cf" data-am-collapse="{target: '#collapse-{{$menu->id}}'}">
                        <span class="{{$menu->icon}}"></span> {{$menu->name}}
                        <span class="am-icon-angle-right am-fr am-margin-right"></span>
                    </a>
                    <ul class="am-list am-collapse admin-sidebar-sub {{$parent_menu == $menu->label ? 'am-in' : ''}}"
                        id="collapse-{{$menu->id}}">
                        @foreach($menu->children as $children)
                            <li>
                                @if(Route::has($children->label))
                                    <a href="{{route($children->label)}}"
                                       class="{{$children_menu == $children->label ? 'am-active' : ''}}">
                                        <span class="{{$children->icon}}"></span> {{$children->name}}
                                    </a>
                                @else
                                    <a href="javascript:void(0);"
                                       class="error_permission">
                                        <span class="am-icon-close"></span> 权限定义错误
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>

        <div class="am-panel am-panel-default admin-sidebar-panel">
            <div class="am-panel-bd">
                <p><span class="am-icon-bookmark"></span> 思 考</p>
                <p>{{$bibel['cn']}}</p>
            </div>
        </div>
        <div class="am-panel am-panel-default admin-sidebar-panel">
            <div class="am-panel-bd">
                <p><span class="am-icon-tag"></span> my-xieqing</p>
                <p>{{$bibel['en']}}</p>
            </div>
        </div>
    </div>
</div>