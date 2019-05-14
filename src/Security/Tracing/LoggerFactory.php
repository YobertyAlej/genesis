<?php

namespace App\Security\Tracing;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerFactory
{
    public static function getLogger($className)
    {

    /**
     * Creates a new instance of a logger
     */

      $path = dirname($_SERVER['DOCUMENT_ROOT']) . '/logs' . '/' . $className . '.log';
      $log = new Logger($className);
      $log->pushHandler(new StreamHandler($path, Logger::ERROR));

      return $log;
    }
}
