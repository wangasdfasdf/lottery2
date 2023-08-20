<?php

namespace app\controller\shop;

use app\controller\Controller;
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

        if (!in_array($file->getUploadExtension(), ['png', 'jpg', 'jpeg'])) {
            return Response::error('文件格式错误');
        }

        $directory = match ($file->getUploadExtension()) {
            'zip' => 'zip',
            default => 'images',
        };

        $filePath = sprintf("%s/%s.%s", $directory, Str::random(40), $file->getUploadExtension());


        $file->move(public_path($filePath));

        $url = config('app.url') . '/' . $filePath;

        return Response::success(compact('url'));
    }
}