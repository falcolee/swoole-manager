<?php

namespace Falcolee\SwooleManager;

use Illuminate\Support\ServiceProvider;

class SwooleManagerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $configPath = __DIR__ . '/../config/swooleman.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('swooleman.php');
        } else {
            $publishPath = base_path('config/swooleman.php');
        }
        $this->publishes([$configPath => $publishPath], 'config');
    }

    public function register(){
        $configPath = __DIR__ . '/../config/swooleman.php';
        $this->mergeConfigFrom($configPath, 'swooleman');
        $this->registerManager();
        $this->registerCommands();
    }

    /**
     * Register manager.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton(SwooleManager::class, function ($app) {
            return new SwooleManager($app, 'laravel');
        });

        $this->app->alias(SwooleManager::class, 'swoole.manager');
    }

    /**
     * Register commands.
     */
    protected function registerCommands()
    {
        $this->commands([
            SwooleHttpServerCommand::class,
        ]);
    }
}
