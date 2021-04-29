<?php
/**
 *
 * User: falco
 * Date: 4/25/21
 * Time: 2:47 PM
 */

return [
    'enabled'          => env('SWOOLEMAN_TIMER', false),

    // The list of cron job
    'jobs'            => [
        // Enable LaravelScheduleJob to run `php artisan schedule:run` every 1 minute, replace Linux Crontab
        // \Falcolee\SwooleManager\Timer\ScheduleJob::class,
    ],

    // Max waiting time of reloading
    'max_wait_time'   => 5,

    // Enable the global lock to ensure that only one instance starts the timer
    // when deploying multiple instances.
    // This feature depends on Redis https://laravel.com/docs/8.x/redis
    'global_lock'     => false,
    'global_lock_key' => config('app.name', 'Laravel'),
];