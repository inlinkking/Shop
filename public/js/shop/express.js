//改变属性
$('.change_attr').click(function () {

//                alert(123);
    var info = {
        id: $(this).parents('tr').data('id'),
        attr: $(this).attr('data-attr')
    };
//                console.log(info);
    var _this = $(this);
//                console.log(_this);
    $.ajax({
        type: 'PATCH',
        url: '/admin/shop/express/change_attr',
        data: info,
        success: function (response) {
            if (response.status == 0) {
                alert(response.msg);
                return false;
            }
            _this.toggleClass('am-icon-check am-icon-remove');
        }
    });
});
//排序
$('.sort_order').change(function () {
//                alert(123);
    var info = {
        id: $(this).parents('tr').data('id'),
        sort_order: $(this).val()
    };
    if (info.sort_order > 99) {
        alert('排序不能大于99');
        return false;
    }
//                console.log(info);
    $.ajax({
        type: 'PATCH',
        url: '/admin/shop/express/sort_order',
        data: info,
        success: function (response) {
            if (response.status == 0) {
                alert(response.msg);
                return false;
            }
            window.location.reload();
        }
    })
});
