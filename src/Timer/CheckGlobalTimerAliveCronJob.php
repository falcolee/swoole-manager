<?php
/**
 * 
 * User: falco
 * Date: 4/25/21
 * Time: 1:45 PM
 */

namespace Falcolee\SwooleManager\Timer;


/**
 * This CronJob is used to check global timer alive.
 * Class CheckGlobalTimerAliveCronJob
 * @package Falcolee\SwooleManager\Timer
 */
class CheckGlobalTimerAliveCronJob extends CronJob
{
    public function interval()
    {
        return (int)(static::GLOBAL_TIMER_LOCK_SECONDS * 0.9) * 1000;
    }

    public function isImmediate()
    {
        return false;
    }

    public function run()
    {
        static::checkSetEnable();
    }
}