
@extends('layouts.wechat.application')

@section('content')
    <div class="page-address-list" data-log="地址列表">
        <div class="header">
            <div class="left">
                <img src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib" border="0"
                     onclick="javascript:history.back(-1);" title="返回上一页">
            </div>
            <div class="tit"><h2 data-log="HEAD-标题-地址列表"><span class="title">地址列表</span></h2></div>
            <div class="right">
                <a href="/">
                    <div class="icon-home icon"></div>
                </a>
            </div>
        </div>
        <div class="address-choose">
            <ul class="ui-card-item ui-list">
                @foreach($address as $add)
                    <li class="ui-list-item item" data-id="{{$add->id}}">
                        <p class="ui_fz30">
                            <span class="consignee">{{$add->name}}</span>
                            <span id="tel">{{$add->tel}}</span>
                        </p>
                        <p>{{$add->province}}  {{$add->city}} {{$add->area}}</p>
                        <p>{{$add->address}}</p>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="add">
            <a href="/address/create" class="ui-button ui-button-active">
                <span>新建地址</span>
            </a>
        </div>
        <div class="popup-risk-check"></div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $("li").click(function () {
                var address_id = $(this).data("id");
//                console.log(address_id);
                $.ajax({
                    type: "PATCH",
                    url: "",
                    data: {address_id: address_id},
                    success: function (data) {
                        location.href = '/order/checkout';
                    }
                })
            })
        })
    </script>
@endsection
