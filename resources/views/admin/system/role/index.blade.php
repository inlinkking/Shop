@extends('layouts.admin.application')
@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户管理组</strong> /
                    <small>Role Brands</small>
                </div>
            </div>
            <hr>
            @include('layouts.admin._flash')
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{route('system.role.create')}}" class="am-btn am-btn-primary">
                                <span class="am-icon-plus"></span>
                                新 增
                            </a>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="am-u-sm-12 am-u-md-3" style="margin-left: 300px;">
                        <div class="am-input-group am-input-group-sm">
                            <input type="text" name="keyword" class="am-form-field"
                                   value="{{Request::input('keyword')}}">
                            <span class="am-input-group-btn">
                            <button class="am-btn am-btn-default" type="submit">搜 索</button>
                            <a class="am-btn am-btn-default" href="{{route('system.role.index')}}">重 置</a>
                        </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="am-g">
                <div class="am-u-sm-12">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th class="table-id">编号</th>
                            <th width="400px;">用户组名</th>
                            <th class="table-date">创建时间</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr style="color: #44b549" class="xParent parent" id="row_{{$role->id}}"
                                data-id="{{$role->id}}">
                                <td>{{$role->id}}</td>
                                <td class="name">{{$role->name}}</td>
                                <td class="am-hide-sm-only">{{$role->created_at}}</td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a style="background-color: #fff;color:#1006f1;"
                                               href="{{route('system.role.edit',$role->id)}}"
                                               class="edit am-btn am-btn-default am-btn-xs am-text-secondary"><span
                                                        class="am-icon-pencil-square-o"></span>
                                                编辑
                                            </a>
                                            @if($role->id != '2')
                                                <a style="background-color: #fff; color:#dd514c;"
                                                   href="{{route('system.role.destroy',$role->id)}}"
                                                   data-method="delete"
                                                   data-token="{{csrf_token()}}" data-confirm="确认删除吗?"
                                                   class="am-btn am-btn-default am-btn-xs am-text-danger">
                                                    <span class="am-icon-trash-o"></span> 删除
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="am-cf all">
                        注 : 共 {{$roles->total()}} 条记录
                        <div class="am-fr all">
                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <footer class="admin-content-footer">
            <hr>
            <p class="am-padding-left">© 2017 my-xieqing Inc. Licensed under MIT license.</p>
        </footer>
    </div>
@endsection
