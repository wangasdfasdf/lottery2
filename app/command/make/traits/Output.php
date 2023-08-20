<?php

namespace app\command\make\traits;

use Symfony\Component\Console\Output\OutputInterface;

trait Output
{
    public function info(OutputInterface $output, string $message)
    {
        $str = sprintf("<info>%s</info>", $message);
        $output->writeln($str);
    }

    public function error(OutputInterface $output, string $message)
    {
        $str = sprintf("<error>%s</error>", $message);
        $output->writeln($str);
    }
}