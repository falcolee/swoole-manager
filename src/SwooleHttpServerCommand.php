<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 2021-04-23
 * Time: 23:17
 */

namespace Falcolee\SwooleManager;

use Falcolee\SwooleManager\Timer\TimerTrait;
use SwooleTW\Http\Commands\HttpServerCommand;
use Illuminate\Support\Arr;
use SwooleTW\Http\Server\Facades\Server;


class SwooleHttpServerCommand extends HttpServerCommand
{
    use TimerTrait;

    protected $swoolemanConfig;

    protected $signature = 'swooleman:http {action : start|stop|restart|reload|infos}';

    protected function hookAction()
    {
        //\Co::set(['hook_flags' => SWOOLE_HOOK_TCP]);
        $this->loadSwoolemanConfigs();
    }

    /**
     * Load configs.
     */
    protected function loadSwoolemanConfigs()
    {
        $this->swoolemanConfig = $this->laravel->make('config')->get('swooleman');
    }

    /**
     * Run swoole_http_server.
     */
    protected function start()
    {
        if ($this->isRunning()) {
            $this->error('Failed! swoole_http_server process is already running.');

            return;
        }

        $host = Arr::get($this->config, 'server.host');
        $port = Arr::get($this->config, 'server.port');
        $hotReloadEnabled = Arr::get($this->config, 'hot_reload.enabled');
        $accessLogEnabled = Arr::get($this->config, 'server.access_log');

        $this->info('Starting swoole http server...');
        $this->info("Swoole http server started: <http://{$host}:{$port}>");
        if ($this->isDaemon()) {
            $this->info(
                '> (You can run this command to ensure the ' .
                'swoole_http_server process is running: ps aux|grep "swoole")'
            );
        }

        $manager = $this->laravel->make(SwooleManager::class);
        $server = $this->laravel->make(Server::class);

        if ($accessLogEnabled) {
            $this->registerAccessLog();
        }

        if ($hotReloadEnabled) {
            $manager->addProcess($this->getHotReloadProcess($server));
        }
        $timerEnabled = Arr::get($this->swoolemanConfig, 'enabled');

        if ($timerEnabled) {
            $manager->addProcess($this->getTimerProcess($server,$this->swoolemanConfig));
        }

        $taskWorkerNum = Arr::get($this->config, 'server.options.task_worker_num');
        $server->set([
            'task_worker_num' => $taskWorkerNum
        ]);

        $this->registerProcess($server);

        $manager->run();
    }

    /**
     * @param \Swoole\WebSocket\Server $server
     */
    public function registerProcess($server)
    {
        $processes = Arr::get($this->config, 'process');
        if (!empty($processes)){
            foreach ($processes as $process) {
                $server->addProcess((new Process())->make($server, $process));
            }
        }
    }
}