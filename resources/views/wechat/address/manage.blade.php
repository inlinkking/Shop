@extends('layouts.wechat.application')

@section('content')
    <div class="page-address-list" data-log="地址列表">
        <div class="address-manage">
            <div class="header">
                <div class="left">
                    <img src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib" border="0"
                         onclick="javascript:history.back(-1);" title="返回上一页">
                </div>
                <div class="tit"><h2 data-log="HEAD-标题-地址管理"><span class="title">地址管理</span></h2></div>
                <div class="right">
                    <a href="/">
                        <div class="icon-home icon"></div>
                    </a>
                </div>
            </div>
            <div class="ui-card">
                @foreach($addresses as $a)
                    <ul class="ui-card-item ui-list">
                        <li class="ui-list-item identity">
                            <a href="/address/{{$a->id}}" data-method="delete"
                               data-token="{{csrf_token()}}" class="delete">删除</a>
                            <span class="consignee">{{$a->name}}</span>
                            <span class="tel">{{$a->tel}}</span>
                        </li>
                        <li class="ui-list-item edit" onclick="location.href='/address/{{$a->id}}/edit'">
                            <p>{{$a->province}} {{$a->city}} {{$a->area}}</p>
                            <p>{{$a->address}}</p>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>

        <div class="add">
            <a href="/address/create" class="ui-button ui-button-active"><span>新建地址</span></a>
        </div>
        <div class="popup-risk-check"></div>
    </div>
@endsection

