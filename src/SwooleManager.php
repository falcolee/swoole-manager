<?php
/**
 *
 * User: falco
 * Date: 4/26/21
 * Time: 1:07 PM
 */

namespace Falcolee\SwooleManager;

use Exception;
use Throwable;
use SwooleTW\Http\Server\Manager;
use Symfony\Component\Debug\Exception\FatalErrorException;

class SwooleManager extends Manager
{

    /**
     * Normalize a throwable/exception to exception.
     *
     * @param \Throwable|\Exception $e
     */
    protected function normalizeException(Throwable $e)
    {
        if (! $e instanceof Exception) {
            if ($e instanceof \ParseError) {
                $severity = E_PARSE;
            } elseif ($e instanceof \TypeError) {
                $severity = E_RECOVERABLE_ERROR;
            } else {
                $severity = E_ERROR;
            }

            $e = new FatalErrorException($e->getMessage(), $e->getCode(), $severity, $e->getFile(), $e->getLine(),null,true, $e->getTrace());
        }

        return $e;
    }
}