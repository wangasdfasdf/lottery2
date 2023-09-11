<?php

namespace app\service;

use OSS\Core\OssException;
use OSS\OssClient;
use support\Log;

class OssService extends BaseService
{
    /**
     * 上传图片
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

}