<?php

namespace App\Api;

use App\Service\LoggerFactory;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ApiLoggerFactory implements LoggerFactory {

    public function createLogger(string $channelName): Logger {
        $logger = new Logger($channelName);
        $formatter = new JsonFormatter();
        $stream = new StreamHandler(__DIR__.'/../../../logs/application-json.log', Logger::DEBUG);
        $stream->setFormatter($formatter);
        $logger->pushHandler($stream);
        return $logger;
    }

}
