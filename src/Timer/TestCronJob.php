<?php
/**
 * 
 * User: falco
 * Date: 4/25/21
 * Time: 3:01 PM
 */

namespace Falcolee\SwooleManager\Timer;


/**
 * This CronJob is used to ensure that timer process does not exit when all timers are cleared(stopped).
 * Class BackupCronJob
 * @package Falcolee\SwooleManager\Timer
 */
class TestCronJob extends CronJob
{
    public function interval()
    {
        return 5 * 1000;
    }

    public function isImmediate()
    {
        return false;
    }

    public function run()
    {
        echo "test";
    }
}