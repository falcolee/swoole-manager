<?php
/**
 * 
 * User: falco
 * Date: 4/25/21
 * Time: 1:33 PM
 */

namespace Falcolee\SwooleManager\Timer;

interface CronJobInterface
{
    public function __construct();

    /**
     * @return int $interval ms
     */
    public function interval();

    /**
     * @return bool $isImmediate
     */
    public function isImmediate();

    public function run();

    public function stop();
}