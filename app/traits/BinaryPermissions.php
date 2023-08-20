<?php

namespace app\traits;

trait BinaryPermissions
{

    /**
     * 添加权限
     *
     * @param int $source
     * @param int $target
     * @return int
     * @created_at 2022/12/3
     */
    public function add(int $source, int $target): int
    {
        return $source | $target;
    }

    /**
     * 移除权限
     *
     * @param int $source
     * @param int $target
     * @return int
     * @created_at 2022/12/3
     */
    public function remove(int $source, int $target): int
    {
        return $source & ~$target;
    }

    /**
     * 是否有某个权限
     *
     * @param int $source
     * @param int $target
     * @return bool
     * @created_at 2022/12/3
     */
    public function has(int $source, int $target): bool
    {
        return ($source & $target) == $target;
    }
}
