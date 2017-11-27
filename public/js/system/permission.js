
function myFunction() {
    var a = $('#icon').val();
    $('#icon').prev('i').attr('class', a);
}
$(".sort_order").change(function () {
//            alert(123);
    var info = {
        id: $(this).parents('tr').data('id'),
        sort_order: $(this).val()
    };
    if (info.sort_order > 99) {
        alert('排序不能大于99');
        return false;
    }
//            console.log(info);
    $.ajax({
        type: 'PATCH',
        url: '/admin/system/permission/sort_order',
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

//折叠
$("#show_all").click(function () {//单击
    // alert(123);
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
    $(".num").attr('style', 'display:none;color:#1A8BE8;');
});
$('tr.nasd').dblclick(function () {
    $(this).toggleClass('am-active');
    $('.chi_' + this.id).toggle();
});
