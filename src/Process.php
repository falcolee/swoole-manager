<?php
/**
 *
 * User: falco
 * Date: 4/25/21
 * Time: 12:09 PM
 */

namespace Falcolee\SwooleManager;
use Swoole\Process as SwooleProcess;

class Process
{
    /**
     * constructor.
     *
     * @param string $filter
     * @param bool $recursively
     * @param string $directory
     */
    public function __construct()
    {

    }

    public function make($server, $process_name)
    {
        return new SwooleProcess(function ($process) use ($server, $process_name) {
            $p = new $process_name($server);
            $p->handle($process);
        }, false, false);
    }
}