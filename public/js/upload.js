//文件上传
var opts = {
    url: "/photos",
    type: "POST",
    beforeSend: function () {
        $("#loading").attr('class', 'am-icon-spinner am-icon-spin');

    },
    success: function (result, status, xhr) {
        if (result.status == 0) {
            alert(result.msg);
            return false;
        }

        $("input[name='image']").val(result.msg);
        $("#img_show").attr("src", result.msg);
        $("#loading").attr('class', 'am-icon-cloud-upload');
    },
    error: function (result, status, errorThrown) {
        alert('文件上传失败');
        $("#loading").attr('class', 'am-icon-cloud-upload');
    }
};

$('#image_upload').fileUpload(opts);