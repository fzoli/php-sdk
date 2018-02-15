<?php

namespace App\Context;

use App\Common\Config\YamlConfigFactory;
use App\Service\LoggerFactory;
use App\Service\ServiceContext;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class RestServiceContextProvider implements ServiceContextProvider {

    public function createServiceContext(): ServiceContext {
        return ServiceContext::builder()
            ->withLoggerFactory(new RestLoggerFactory())
            ->withConfigFactory(new YamlConfigFactory())
            ->build();
    }

}

class RestLoggerFactory implements LoggerFactory {

    public function createLogger(string $channelName): Logger {
        $logger = new Logger($channelName);
        $formatter = new JsonFormatter();
        $stream = new StreamHandler(__DIR__.'/../../../logs/application-json.log', Logger::DEBUG);
        $stream->setFormatter($formatter);
        $logger->pushHandler($stream);
        return $logger;
    }

}
