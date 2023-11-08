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

if (!function_exists('getRandomOrderNum')) {
    function getRandomOrderNum($end, $prefix = ''): string
    {
        $full = (string)(rand(0, 9999999999999999)) . (string)(rand(0, 9999999999999999));
        return substr($prefix . $full, 0, $end);
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($lens, $letters, $numbers, $letterCount): string
    {
        $randomString = '';
        // 生成位置索引数组
        $positions = range(0, $lens - 1);
        shuffle($positions); // 随机打乱位置索引数组顺序
        // 插入英文字母
        for ($i = 0; $i < $letterCount; $i++) {
            $position = $positions[$i];
            $randomString = substr($randomString, 0, $position) . $letters[rand(0, count($letters) - 1)] .
                substr($randomString, $position);
        }

        // 插入数字
        for ($i = $letterCount; $i < $lens; $i++) {
            $position = $positions[$i];
            $randomString = substr($randomString, 0, $position) . $numbers[rand(0, count($numbers) - 1)] .
                substr($randomString, $position);
        }
        return $randomString;
    }
}

if (!function_exists('getRandomSuffix_jc')) {
    function getRandomSuffix_jc(): string
    {
        $lens = 8;
        $letters = ['A', 'B', 'C', 'D', 'E', 'F'];
        $numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $letterCount = rand(3, 5);
        return generateRandomString($lens, $letters, $numbers, $letterCount);
    }

}

if (!function_exists('getRandomSuffix_bd')) {
    function getRandomSuffix_bd(): string
    {
        $lens = 13;
        $letters = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T",
            "U", "V", "W", "X", "Y", "Z"
        ];
        $numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $letterCount = rand(6, 10);
        return generateRandomString($lens, $letters, $numbers, $letterCount);
    }
}

if (!function_exists('getRandomSuffix_pls')) {
    function getRandomSuffix_pls(): string
    {
        $lens = 6;
        $letters = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T",
            "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "p", "q",
            "r", "s", "t", "u", "v", "w", "x", "y", "z", "+"
        ];
        $numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $letterCount = rand(3, 5);
        $randomString = '';
        $positions = range(0, $lens - 1);
        shuffle($positions);
        for ($i = 0; $i < $letterCount; $i++) {
            $position = $positions[$i];
            $letterIndex = str_contains($randomString, '+') ? rand(0, count($letters) - 2) : rand(0, count($letters) - 1);
            $randomString = substr($randomString, 0, $position) . $letters[$letterIndex] . substr($randomString, $position);
        }
        for ($i = $letterCount; $i < $lens; $i++) {
            $position = $positions[$i];
            $randomString = substr($randomString, 0, $position) . $numbers[rand(0, count($numbers) - 1)] . substr($randomString, $position);
        }
        return $randomString;
    }

}


if (!function_exists('get_order_num')) {
    function get_order_num($match_type, $order_prefix = ''): string
    {
        // 顶部订单编号生成
        if ($match_type == 'bjdc') {
            // 6位-6位-6位-6位，北单指定要求字符串
            return getRandomOrderNum(6) . '-' . getRandomOrderNum(6) . '-' . getRandomOrderNum(6) . '-' . getRandomOrderNum(6) . ',' . getRandomSuffix_bd();
        } elseif ($match_type == 'pls') {
            // 6位-6位-6位-6位-6位，排列三指定要求字符串
            return getRandomOrderNum(6) . '-' . getRandomOrderNum(6) . '-' . getRandomOrderNum(6) . '-' . getRandomOrderNum(6) . ',' . getRandomOrderNum(6) . ',' . getRandomSuffix_pls();
        } else {
            // 24位指定前缀数字这里的前缀是/shop/v1/info返回的order_prefix字段），8位数字，竞彩指定要求字符串
            return getRandomOrderNum(24, $order_prefix) . ',' . getRandomOrderNum(8) . ',' . getRandomSuffix_jc();
        }
    }
}

if (!function_exists('format_result_bf')) {
    function format_result_bf(string $r): string
    {
        $arr = ['1:0', '2:0', '2:1', '3:0', '3:1', '3:2', '4:0', '4:1', '4:2', '5:0', '5:1', '5:2', '0:0', '1:1', '2:2', '3:3', '0:1', '0:2', '1:2', '0:3', '1:3', '2:3', '0:4', '1:4', '2:4', '0:5', '1:5', '2:5',];

        if (in_array($r, $arr)) {
            return $r;
        }

        list($i, $j) = explode(':', $r);

        return match (true) {
            $i < $j => '负其他',
            $i == $j => '平其他',
            $i > $j => '胜其他',
        };
    }
}

if (!function_exists('format_result_bd_jq')) {
    function format_result_bd_jq($r): string
    {
        $r = (int)$r;

        if ($r >= 7) {
            return "7+";
        } else {
            return $r;
        }
    }
}

if (!function_exists('format_jc_amount')) {
    function format_jc_amount($amount): float|int
    {
        $io = $amount * 100;
        $i = (string)(int)($amount * 1000);

        $len = strlen($i);

        $i1 = (int)$i[$len - 1];
        $i2 = (int)$i[$len - 2];

        if ($i1 != 5) {
            return round($amount, 2);
        } else {
            $n = $i2 & 1 ? ceil($io) : floor($io);
            return bcdiv($n, 100, 2);
        }
    }
}