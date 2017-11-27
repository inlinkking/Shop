//折叠
$("#show_all").click(function () {//单击
    $('tr.xParent').addClass('am-active');
    $('tr.xChildren').attr('style', 'display:table-row;color: #1A8BE8');
});
//折叠
$('#hide_all').click(function () {
    $('tr.xParent').removeClass('am-active');
    $('tr.xChildren').attr('style', 'display:none;');
});

$("tr.xParent").dblclick(function () {//双击
    $(this).toggleClass('am-active');
    $(".child_" + this.id).toggle();
});
//是否显示
$('.change_attr').click(function () {
    // alert(123);
    var info = {
        id: $(this).parents('tr').data('id'),
        attr: $(this).attr('data-attr')
    };
    // console.log(info);
    var _this = $(this);
    // console.log(_this);
    $.ajax({
        type: 'PATCH',
        url: '/admin/shop/category/change_attr',
        data: info,
        success: function (response) {
            if (response.status == 0) {
                alert(response.msg);
                return false;
            }
            _this.toggleClass('am-icon-check am-icon-remove');
//                        window.location.reload();
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
//                console.log(info);return false;
    $.ajax({
        type: 'PATCH',
        url: '/admin/shop/category/sort_order',
        data: info,
        success: function (response) {
            if (response.status == 0) {
                alert(response.msg);
                return false;
            }
            window.location.reload();
        }
    });
});