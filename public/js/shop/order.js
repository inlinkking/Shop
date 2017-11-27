$(function () {
    $(".J_deliveryTrigger").click(function () {
        var $detail = $(".uc-order-item .order-delivery-detail");
        if (!$detail.is(":visible")) {
            $(this).html('收起物流详情 <i class="iconfont am-icon-angle-up"></i>');
        } else {
            $(this).html('展开物流详情 <i class="iconfont am-icon-angle-down"></i>');
        }
        $detail.slideToggle(300);
    });
    //配货
    $('#picking').click(function () {
        var id = $(this).parents('div').data('id');
        // console.log(id);
        $.ajax({
            type: 'PATCH',
            url: '/admin/shop/order/picking',
            data: {id: id},
            success: function (data, response) {
                if (response.status == 0) {
                    alert(response.msg);
                    return false;
                }
                if (data.status == 0) {
                    alert(data.msg);
                    return false;
                }
                window.location.reload();
            }
        })
    });
    //出库
    $('#shipping').click(function () {
        var data = {
            id: $(this).parents('div').data('id'),
            status: $(this).data('status'),
            express_code: $('#express_code').val(),
            express_id: $('#express_id').val()
        };
        if (data.express_code == '') {
            alert('快递单号不能为空');
            return false;
        }
        // console.log(data);
        $.ajax({
            type: 'PATCH',
            url: '/admin/shop/order/shipping',
            data: data,
            success: function (data, response) {
                if (response.status == 0) {
                    alert(response.msg);
                    return false;
                }
                if (data.status == 0) {
                    alert(data.msg);
                    return false;
                }
                location.href = location.href;
            }
        });
        return false;
    });

    //交易成功
    $('#finish').click(function () {
        var data = {
            id: $(this).parents('div').data('id')
        };
        $.ajax({
            type: 'PATCH',
            url: '/admin/shop/order/finish',
            data: data,
            success: function (data, response) {
                if (response.status == 0) {
                    alert(response.msg);
                    return false;
                }
                if (data.status == 0) {
                    alert(data.msg);
                    return false;
                }
                window.location.reload();
            }
        });
        return false;
    })
});