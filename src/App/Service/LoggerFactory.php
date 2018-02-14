<?php

namespace App\Service;


use Monolog\Logger;

interface LoggerFactory {
    public function createLogger(string $channelName): Logger;
}
