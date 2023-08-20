<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace support;

/**
 * Class Response
 * @package support
 */
class Response extends \Webman\Http\Response
{
    public static function success($data = [], string $message = 'ok'): Response
    {
        return json([
            'code' => 200,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public static function error(string $message, $data = []): Response
    {
        return json([
            'code' => 400,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public static function res($code = 200, string $message = '', $data = [], $http_code = 200): Response
    {
        return response(json_encode([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ]), $http_code, ['Content-Type' => 'application/json']);
    }
}