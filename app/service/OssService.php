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

    public function policy(string $dir): array
    {
        $id  = config('ali.oss.accessKeyId');
        $key = config('ali.oss.accessKeySecret');
        $bucket = config('ali.oss.bucket');
        $endpoint =config('ali.oss.endpoint');



        // $host的格式为 bucketname.endpoint，请替换为您的真实信息。
        $host = \sprintf("https://%s.%s", $bucket,$endpoint );;
        // $callbackUrl为上传回调服务器的URL，请将下面的IP和Port配置为您自己的真实URL信息。
        $callbackUrl = '';


        $callback_param  = array(
            'callbackUrl'      => $callbackUrl,
            'callbackBody'     => 'filename=${object}&size=${size}&mimeType=${mimeType}&height=${imageInfo.height}&width=${imageInfo.width}',
            'callbackBodyType' => "application/x-www-form-urlencoded"
        );
        $callback_string = json_encode($callback_param);

        $base64_callback_body = base64_encode($callback_string);
        $now                  = time();
        $expire               = 30;  //设置该policy超时时间是10s. 即这个policy过了这个有效时间，将不能访问。
        $end                  = $now + $expire;
        $expiration           = $this->gmtIso8601($end);


        //最大文件大小.用户可以自己设置
        $condition    = array(0 => 'content-length-range', 1 => 0, 2 => 1048576000);
        $conditions[] = $condition;

        // 表示用户上传的数据，必须是以$dir开始，不然上传会失败，这一步不是必须项，只是为了安全起见，防止用户通过policy上传到别人的目录。
        $start        = array(0 => 'starts-with', 1 => '$key', 2 => $dir);
        $conditions[] = $start;


        $arr            = array('expiration' => $expiration, 'conditions' => $conditions);
        $policy         = json_encode($arr);
        $base64_policy  = base64_encode($policy);
        $string_to_sign = $base64_policy;
        $signature      = base64_encode(hash_hmac('sha1', $string_to_sign, $key, true));

        $response              = array();
        $response['accessid']  = $id;
        $response['host']      = $host;
        $response['policy']    = $base64_policy;
        $response['signature'] = $signature;
        $response['expire']    = $end;
        $response['callback']  = $base64_callback_body;
        $response['dir']       = $dir;  // 这个参数是设置用户上传文件时指定的前缀。
        return $response;
    }

    public function gmtIso8601($time): array|string
    {
        return str_replace('+00:00', '.000Z', gmdate('c', $time));
    }

}