//改变属性
$('.change_attr').click(function () {
    // alert(123);
    var info = {
        id: $(this).parents('tr').data('id'),
        attr: $(this).attr('data-attr')
    };
//            console.log(info);
    var _this = $(this);
//                console.log(_this);
    $.ajax({
        type: 'PATCH',
        url: '/admin/shop/product/change_attr',
        data: info,
        success: function (response) {
            if (response.status == 0) {
                alert(response.msg);
                return false;
            }
            _this.toggleClass('am-icon-check am-icon-remove');
        }
    })
    ;
});
//库存
$('.stock').change(function () {
    // alert(123);
    var info = {
        id: $(this).parents('tr').data('id'),
        stock: $(this).val()
    };
//            console.log(info);
    $.ajax({
        type: 'PATCH',
        url: '/admin/shop/product/stock',
        data: info,
        success: function (response) {
            if (response.status == 0) {
                alert(response.msg);
                return false;
            }
        }
    })
});
//软删除单挑
// $(document).on('click', '.delete', function () {
// //            alert(123);
//     if (confirm('确定移动到回收站么')) {
//         var id = $(this).parents('tr').data('id');
//     }
//     $.ajax({
//         type: 'PATCH',
//         url: '/admin/shop/product/delete',
//         data: {id: id},
//         success: function (response) {
//             if (response.status == 0) {
//                 alert(response.msg);
//                 return false;
//             }
//             window.location.reload();
//         }
//     })
// });
//删除多条到回收站
$("#del_more").click(function () {
    var length = $(".checked_id:checked").length;
    if (length == 0) {
        alert('最少选中一条');
        return false;
    }
//            console.log(length);
//            alert(123);
    if (confirm('是否都移除到回收站')) {
        var id = $(".checked_id:checked").serialize();
//                console.log(id);return false;
        $.ajax({
            type: 'PATCH',
            url: '/admin/shop/product/delete',
            data: id,
            success: function (response) {
                if (response.status == 0) {
                    alert(response.msg);
                    return false;
                }
                window.location.reload();
            }
        })
    }
});