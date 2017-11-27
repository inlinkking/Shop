

$(document).ready(function () {
    NProgress.start();
});
$(window).load(function () {
    NProgress.done();
});


//全选
$('#checkAll').click(function () {
    var check = $(this).prop('checked');
    $('.checkOne').prop('checked', check);
});
$('.checkOne').click(function () {
    var status = true;
    $('.checkOne').each(function () {
        if (!$(this).prop('checked')) {
            status = false;
        }
    });
    $('#checkAll').prop('checked', status);
});
var opts = {
    type: 'POST',
    url: "/photos",
    beforeSend: function () {
        $("#loading").attr('class', 'am-icon-spinner am-icon-spin');
    },
    success: function (result, status) {
        $("input[name='image']").val(result.msg);
        $("#img_show").attr('src', result.msg);
        $("#loading").attr('class', 'am-icon-cloud-upload');
    },
    error: function () {
        alert('图片上传失败');
        $("#loading").attr('class', 'am-icon-cloud-upload');
    }
};
$("#image_upload").fileUpload(opts);