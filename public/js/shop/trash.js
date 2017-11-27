//软删除单挑
$(document).on('click', '#del_hui', function () {
    // alert(123);
    if (confirm('确定移动到商品列表')) {
        var id = $(this).parents('tr').data('id');
//                console.log(id);
        $.ajax({
            type: 'PATCH',
            url: '/admin/shop/trash/del_all',
            data: {id: id},
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
//软删除多条
$("#del_all").click(function () {
    var length = $(".checked_id:checked").length;
//            console.log(length);
    if (length == 0) {
        alert('最少选择一条');
        return false;
    }
    if (confirm('确定都移动到商品里')) {
        var id = $(".checked_id:checked").serialize();
        $.ajax({
            type: 'PATCH',
            url: '/admin/shop/trash/del_bin',
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
//彻底删除单挑
$(document).on('click', '#delete_dan', function () {
    if (confirm('确定永久删除')) {
        var id = $(this).parents('tr').data('id');
//                          console.log(id);
        $.ajax({
            type: 'DELETE',
            url: '/admin/shop/trash/delete',
            data: {id: id},
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
//彻底删除多
$("#delete_all").click(function () {
    var length = $(".checked_id:checked").length;
    if (length == 0) {
        alert('至少选中一条');
        return false;
    }
    if (confirm('确定全部永久删除')) {
        var id = $(".checked_id:checked").serialize();
        $.ajax({
            type: 'DELETE',
            url: '/admin/shop/trash/delete_all',
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