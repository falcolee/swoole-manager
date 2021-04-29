## swoole manager

## config
`php artisan vendor:publish --provider="Falcolee\SwooleManager\SwooleManagerServiceProvider"`

## timer
`config/swooleman.php`
```$xslt
        // Enable LaravelScheduleJob to run `php artisan schedule:run` every 1 minute, replace Linux Crontab
        // \Falcolee\SwooleManager\Timer\ScheduleJob::class,
```

## run
Same as swooletw.

eg. 
`php artisan swooleman:http start`