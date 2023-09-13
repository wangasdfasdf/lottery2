<?php

namespace app\controller\admin;

use app\controller\Controller;
use app\service\OssService;
use Illuminate\Support\Str;
use support\Request;
use support\Response;

class UploadController extends Controller
{
    public function upload(Request $request): Response
    {

        if (empty($request->file('file'))) {
            return Response::error('请传递正确的文件');
        }

        $file = $request->file('file');

        if (!in_array($file->getUploadExtension(), ['zip', 'png', 'jpg', 'jpeg'])) {
            return Response::error('文件格式错误');
        }

        $directory = match ($file->getUploadExtension()) {
            'zip' => 'zip',
            default => 'images',
        };



        $filePath = sprintf("%s/%s.%s", $directory, Str::random(40), $file->getUploadExtension());

        OssService::instance()->uploadFile($filePath, $file->getRealPath());

        $url = config('ali.oss.cname_domain') . '/' . $filePath;

//        $file->move(public_path($filePath));


        return Response::success(compact('url'));
    }

    /**
     * 获取上传令牌
     *
     */
    public function policy(): Response
    {
        $result = OssService::instance()->policy('admin');

        return Response::success(compact('result'));
    }
}