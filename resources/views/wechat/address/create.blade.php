@extends('layouts.wechat.application')

@section('content')
    <div class="page-address-edit" data-log="新增地址">
        <div class="header">
            <div class="left">
                <img src="http://s1.mi.com/m/images/m/icon_back_n.png" class="ib" border="0"
                     onclick="javascript:history.back(-1);" title="返回上一页">
            </div>
            <div class="tit"><h2 data-log="HEAD-标题-商品列表"><span class="title">新增地址</span></h2></div>
            <div class="right">
                <a href="/">
                    <div class="icon-home icon"></div>
                </a>
            </div>
        </div>
        <div class="edit-box">
            <ul class="ui-list">
                <li class="ui-list-item">
                    <div class="label">收货人：</div>
                    <div class="ui-input"><input placeholder="真实姓名" name="name" maxlength="15" type="text">
                    </div>
                </li>
                <li class="ui-list-item">
                    <div class="label">手机号码：</div>
                    <div class="ui-input">
                        <input placeholder="手机号" id="tel" name="tel" type="tel">
                    </div>
                </li>
                <li class="ui-list-item">
                    <div class="label">所在地区：</div>
                    <div class="ui-input">
                        <input placeholder="省 市 区" name="pca" id="pca" maxlength="20" type="text" readonly="readonly"
                               value="">
                    </div>
                </li>
                <li class="ui-list-item">
                    <div class="label">街道地址：</div>
                    <div class="ui-input"><input placeholder="详细地址" name="address" maxlength="120" type="text">
                    </div>
                </li>
            </ul>
            <div class="save-button">
                <a href="javascript:void(0);" class="ui-button"><span>保存地址</span></a>
            </div>
        </div>


        <div class="ui-mask" style="display:none;"></div>
        <div class="ui-pop" style="display:none;">
            <div class="ui-pop-content">
                <div class="region-list" id="city">
                </div>
                <div class="ui-pop-title">选择所在地区</div>
                <div class="ui-pop-close"><a><span class="icon-10chahaokuang"></span></a></div>
            </div>


            <div class="popup-risk-check"></div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/wechat/js/citySelect.js"></script>
    <script>
        $(function () {
            $('.save-button').click(function () {
                var phone = document.getElementById('tel').value;
                if (!(/^1[34578]\d{9}$/.test(phone))) {
                    alert('请填写正确的手机号');
                    return false;
                }
                var status = true;
                $('input').each(function () {
                    var val = $(this).val();
                    if (val == '') {
                        status = false;
                    }
                });
                if (status == false) {
                    alert('您填写的地址不完整');
                    return false;
                }
                var data = $('input').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/address',
                    data: data,
                    success: function (data) {
                        location.href = '/address'
                    }
                })
            })
        });
    </script>
@endsection