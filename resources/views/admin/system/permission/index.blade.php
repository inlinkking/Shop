@extends('layouts.admin.application')
@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">菜单与权限</strong> /
                    <small>Permissions Brands</small>
                </div>
            </div>
            <hr>
            @include('layouts.admin._flash')
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{route('system.permission.create')}}" class="am-btn am-btn-primary">
                                <span class="am-icon-plus"></span>
                                新 增
                            </a>
                            <button type="button" id="show_all" class="am-btn am-btn-success"><span
                                        class="am-icon-expand"></span> 展开
                            </button>
                            <button type="button" id="hide_all" class="am-btn am-btn-secondary"><span
                                        class="am-icon-compress"></span> 折叠
                            </button>

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="am-g">
                <div class="am-u-sm-12">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th width="200px;">编号</th>
                            <th width="500px;">菜单</th>
                            <th width="300px;">排序</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr class="xParent parent" id="row_{{$permission->id}}"
                            style="color: #ff2222"    data-id="{{$permission->id}}">
                                <td>{{$permission->id}}</td>
                                <td class="name"><span class="{{$permission->icon}}"></span> {{$permission->name}}
                                    (<span class="label">{{$permission->label}}</span>)
                                </td>
                                <td class="am-hide-sm-only">
                                    <input type="text" style="width: 50px;height: 30px;" class="sort_order"
                                           value="{{$permission->sort_order}}"></td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a style="background-color: #fff;color:#1006f1;"
                                               href="{{route('system.permission.edit',$permission->id)}}"
                                               class="edit am-btn am-btn-default am-btn-xs am-text-secondary"><span
                                                        class="am-icon-pencil-square-o"></span>
                                                编辑
                                            </a>
                                            <a style="background-color: #fff; color:#dd514c;"
                                               href="{{route('system.permission.destroy',$permission->id)}}"
                                               data-method="delete"
                                               data-token="{{csrf_token()}}" data-confirm="确认删除吗?"
                                               class="am-btn am-btn-default am-btn-xs am-text-danger">
                                                <span class="am-icon-trash-o"></span> 删除
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @foreach($permission->children as $child)
                                <tr class="xChildren child_row_{{$permission->id}} nasd" id="rom_{{$child->id}}"
                                    style="display: none;color:#1A8BE8;"
                                    data-id="{{$child->id}}">
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$child->id}}</td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
                                                class="{{$child->icon}}"></span>&nbsp;{{$child->name}}
                                        ({{$child->label}})
                                    </td>
                                    <td class="am-hide-sm-only">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" style="width: 50px;height: 30px;" class="sort_order"
                                               value="{{$child->sort_order}}"></td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a style="background-color: #fff;color:#1006f1;" class="am-btn
                                                am-btn-default am-btn-xs am-text-secondary"
                                                   href="{{route('system.permission.edit',$child->id)}}"><span
                                                            class="am-icon-pencil-square-o"></span>
                                                    编辑
                                                </a>
                                                <a style="background-color: #fff; color:#dd514c;"
                                                   href="{{route('system.permission.destroy',$child->id)}}"
                                                   data-method="delete"
                                                   data-token="{{csrf_token()}}" data-confirm="确认删除吗?"
                                                   class="am-btn am-btn-default am-btn-xs am-text-danger">
                                                    <span class="am-icon-trash-o"></span> 删除
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @foreach($child->children as $chi)
                                    <tr class="xChildren num chi_rom_{{$child->id}}"
                                        style="display: none;color:#1A8BE8;"
                                        data-id="{{$chi->id}}">
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$chi->id}}</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$chi->name}}({{$chi->label}})
                                        </td>
                                        <td class="am-hide-sm-only">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="text" style="width: 50px;height: 30px;" class="sort_order"
                                                   value="{{$chi->sort_order}}"></td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <a style="background-color: #fff;color:#1006f1;"
                                                       href="{{route('system.permission.edit',$chi->id)}}"
                                                       class="edit am-btn am-btn-default am-btn-xs am-text-secondary"><span
                                                                class="am-icon-pencil-square-o"></span> 编辑
                                                    </a>
                                                    <a style="background-color: #fff; color:#dd514c;"
                                                       href="{{route('system.permission.destroy',$chi->id)}}"
                                                       data-method="delete"
                                                       data-token="{{csrf_token()}}" data-confirm="确认删除吗?"
                                                       class="am-btn am-btn-default am-btn-xs am-text-danger">
                                                        <span class="am-icon-trash-o"></span> 删除
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="am-cf">
        </div>
        <footer class="admin-content-footer">
            <hr>
            <p class="am-padding-left">© 2017 my-xieqing Inc. Licensed under MIT license.</p>
        </footer>
    </div>
@endsection
@section('js')
    <script src="/js/system/permission.js"></script>
@endsection