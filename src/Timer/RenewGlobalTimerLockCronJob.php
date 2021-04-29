<?php
/**
 * 
 * User: falco
 * Date: 4/25/21
 * Time: 1:44 PM
 */

namespace Falcolee\SwooleManager\Timer;

/**
 * This CronJob is used to renew the cache key of global timer.
 * Class RenewGlobalTimerLockCronJob
 * @package Falcolee\SwooleManager\Timer
 */
class RenewGlobalTimerLockCronJob extends CronJob
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
        static::isCurrentTimerAlive() && static::renewGlobalTimerLock(static::GLOBAL_TIMER_LOCK_SECONDS);
    }
}