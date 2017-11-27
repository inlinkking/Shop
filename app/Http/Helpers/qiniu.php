<?php
/**
 * Created by PhpStorm.
 * User: xieqi
 * Date: 2017/9/13
 * Time: 15:11
 */

// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;

function qiniu_upload($filePath)
{
// 需要填写你的 Access Key 和 Secret Key
    $accessKey = "ZJwCZroewWuTz0iv3dVwg9gqTx2sYpbRcZLgym66";
    $secretKey = "4GRo0d0WMQmuCvkj_8vunqjjPHA7VHGuH6mNA1fE";
// 构建鉴权对象
    $auth = new Auth($accessKey, $secretKey);
//要上传的空间
    $bucket = 'my-xieqing';
// 生成上传 Token
    $token = $auth->uploadToken($bucket);
// 上传到七牛后保存的文件名
    $key = basename($filePath);
// 初始化 UploadManager 对象并进行文件的上传。
    $uploadMgr = new UploadManager();
// 调用 UploadManager 的 putFile 方法进行文件的上传。
    $uploadMgr->putFile($token, $key, $filePath);
    //删除本地图片
    unlink($filePath);
}
