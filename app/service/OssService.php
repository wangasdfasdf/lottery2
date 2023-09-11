<?php

namespace app\service;

use OSS\Core\OssException;
use OSS\OssClient;
use support\Log;

class OssService extends BaseService
{
    /**
     * 上传内容
     *
     * @param $object
     * @param $content
     * @return void
     */
    public function put($object, $content): void
    {
        $accessKeyId = config('ali.oss.accessKeyId');
        $accessKeySecret = config('ali.oss.accessKeySecret');
        $endpoint = config('ali.oss.endpoint');
        $bucket = config('ali.oss.bucket');

        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

            $ossClient->putObject($bucket, $object, $content);
        } catch (OssException $e) {
            Log::info("oss.log", [$e->getMessage()]);
            return;
        }
    }

    /**
     * 上传文件
     *
     * @param $object
     * @param $path
     * @return void
     */
    public function uploadFile($object, $path): void
    {
        $accessKeyId = config('ali.oss.accessKeyId');
        $accessKeySecret = config('ali.oss.accessKeySecret');
        $endpoint = config('ali.oss.endpoint');
        $bucket = config('ali.oss.bucket');

        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

            $ossClient->uploadFile($bucket, $object, $path);
        } catch (OssException $e) {
            Log::info("oss.log", [$e->getMessage()]);
            return;
        }
    }

}