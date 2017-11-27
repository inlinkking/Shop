<?php

namespace App\Http\Controllers;

use function Couchbase\basicEncoderV1;
use Illuminate\Http\Request;
use YuanChao\Editor\EndaEditor;

class PhotoController extends Controller
{

    public function postUpload(){


        // endaEdit 为你 public 下的目录 update 2015-05-19
        $data = EndaEditor::uploadImgFile('endaEdit');

        return json_encode($data);
    }


    /**
     * 上传图片
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image') && $request->image->isValid()) {
            $allow_types = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
            if (!in_array($request->image->getMimeType(), $allow_types)) {
                return ['status' => 0, 'msg' => '图片类型不正确'];
            }
            if ($request->image->getClientSize() > 1024 * 1024 * 3) {
                return ['status' => 0, 'msg' => '图片不能大于3M'];
            }

            $path = $request->image->store('public/images');
            //绝对路径
            $file_path = storage_path('app/') . $path;
            //上传到本地
//            return ['status' => 1, 'msg' => '/storage' . str_replace('public', '', $path)];
            //上传到七牛
            qiniu_upload($file_path);
            return ['status' => 1, 'msg' => 'http://ow5jvs0fi.bkt.clouddn.com/' . basename($file_path)];
        }
    }
}
