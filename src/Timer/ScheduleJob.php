<?php
/**
 * 
 * User: falco
 * Date: 4/25/21
 * Time: 1:58 PM
 */

namespace Falcolee\SwooleManager\Timer;
use Illuminate\Contracts\Console\Kernel;

class ScheduleJob extends CronJob
{
    public function interval()
    {
        return 60 * 1000;// Run every 1 minute
    }

    public function isImmediate()
    {
        return false;
    }

    public function run()
    {
        app(Kernel::class)->call('schedule:run');
    }
}