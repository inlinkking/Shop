$('.sort_order').change(function () {
    var info = {
        id: $(this).parents('tr').data('id'),
        sort_order: $(this).val()
    };
    if (info.sort_order > 99) {
        alert('排序不能大于99');
        return false;
    }
    // console.log(info);
    $.ajax({
        type: 'PATCH',
        url: "/admin/ads/ad_category/sort_order",
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
