<?php
/**
 * Here is your custom functions.
 */

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use support\exception\DdException;

if (!function_exists('d')) {
    /**
     * @throws DdException
     */
    function d(...$vars)
    {
        throw new DdException($vars);
    }
}


/**
 * 密码哈希
 * @param $password
 * @param string $algo
 * @return false|string|null
 */
if (!function_exists('passwordHash')) {
    function passwordHash($password, string $algo = PASSWORD_DEFAULT): string
    {
        return password_hash($password, $algo);
    }
}


/**
 * 验证密码哈希
 * @param $password
 * @param $hash
 * @return bool
 */

if (!function_exists('passwordVerify')) {
    function passwordVerify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}


/**
 * Create a new Carbon instance for the current time.
 */
if (!function_exists('now')) {
    function now($tz = null): Carbon
    {
        return Date::now($tz);
    }
}