<?php

namespace support\exception;

use Respect\Validation\Exceptions\Exception;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Throwable;
use Webman\Exception\ExceptionHandler;
use Webman\Http\Request;
use Webman\Http\Response;

class Handlers extends ExceptionHandler
{
    /**
     * 记录日志
     * @param Throwable $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }


    /**
     * 渲染返回
     * @param Request $request
     * @param Throwable $exception
     * @return Response
     */
    public function render(Request $request, Throwable $exception): Response
    {

        if ($exception instanceof Exception) {
            $json = ['code' => 422, 'msg' => $exception->getMessage()];
            return \response(json_encode($json), 422, ['Content-Type' => 'application/json']);
        }

        if ($exception instanceof TipsException) {

            $code = $exception->getCode();
            $json = ['code' => $code ?: 500, 'msg' => $exception->getMessage()];

            return \response(json_encode($json), 200, ['Content-Type' => 'application/json']);

//            return new Response(200, [], $exception->getMessage());
        }

        if ($exception instanceof DdException) {
            $dump = function ($var) {
                $data = (new VarCloner())->cloneVar($var)->withMaxDepth(3);

                return (string)(new HtmlDumper(false))->dump($data, true, [
                    'maxDepth' => 3,
                    'maxStringLength' => 160,
                ]);
            };

            $arr = json_decode($exception->getMessage(), true);
            return new Response(200, [], collect($arr)->map($dump)->implode(''));
        }

        return parent::render($request, $exception);
    }
}