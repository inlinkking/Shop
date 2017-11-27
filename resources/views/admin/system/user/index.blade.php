@extends('layouts.admin.application')
@section('content')
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户管理</strong> /
                    <small>User Brands</small>
                </div>
            </div>
            <hr>
            @include('layouts.admin._flash')
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{route('system.user.create')}}" class="am-btn am-btn-primary">
                                <span class="am-icon-plus"></span>
                                新 增
                            </a>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <form method="get">
                        <div class="am-input-group am-input-group-sm">
                            <input type="text" class="am-form-field" name="keyword"
                                   value="{{Request::input('keyword')}}">
                            <span class="am-input-group-btn">
                                <button class="am-btn am-btn-default" type="submit">搜 索</button>
                                <a class="am-btn am-btn-default" href="{{route('system.user.index')}}">重 置</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="am-g">
                <div class="am-u-sm-12">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>用户名</th>
                            <th>真实姓名</th>
                            <th>所属用户组</th>
                            <th>邮箱</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->real}}</td>
                                <td>{{$user->roles->implode('name',', ')}}</td>
                                <td>{{$user->email}}</td>
                                <td class="am-hide-sm-only">{{$user->created_at}}</td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a style="background-color: #fff;color:#1006f1;"
                                               href="{{route('system.user.edit',$user->id)}}"
                                               class="edit am-btn am-btn-default am-btn-xs am-text-secondary"><span
                                                        class="am-icon-pencil-square-o"></span>
                                                编辑
                                            </a>
                                            @if($user->id != '1')
                                                <a style="background-color: #fff; color:#dd514c;"
                                                   href="{{route('system.user.destroy',$user->id)}}"
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
                        注 : 共 {{$users->total()}} 条记录
                        <div class="am-fr all">
                            {{ $users->links() }}
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
