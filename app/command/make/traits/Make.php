<?php

namespace app\command\make\traits;

trait Make
{

    /**
     * 检查要生成的文件是否存在
     *
     * @param string $savePath
     * @return array
     */
    public function checkFile(string $savePath): array
    {
        if (file_exists($savePath)) {
            return  [false, "file already exist --{$savePath}"];

        }
        return [true, ''];
    }


    /**
     * 保存文件
     *
     * @param string $savePath
     * @param string $file
     * @return array
     */
    public function saveFile(string $savePath, string $file): array
    {
        if (!file_exists(dirname($savePath))) {
            mkdir(dirname($savePath), 0755, true);
        }

        $result = file_put_contents($savePath, $file);

        if ($result) {

            return  [true, "file create success --{$savePath}"];
        }
        return  [false, "file already exist --{$savePath}"];
    }
}
