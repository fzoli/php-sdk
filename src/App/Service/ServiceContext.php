<?php

namespace App\Service;

/**
 * Immutable Service context.
 * @package App\Service
 */
class ServiceContext {

    static function builder(): ServiceContextBuilder {
        return new ServiceContextBuilder();
    }

    private $loggerFactory;

    public function __construct(ServiceContextBuilder $builder) {
        $this->loggerFactory = $builder->getLoggerFactory();
    }

    public function getLoggerFactory(): LoggerFactory {
        return $this->loggerFactory;
    }

}

class ServiceContextBuilder {

    private $loggerFactory;

    public function __construct() {
    }

    public function build(): ServiceContext {
        return new ServiceContext($this);
    }

    public function getLoggerFactory(): LoggerFactory {
        return $this->loggerFactory;
    }

    public function withLoggerFactory(LoggerFactory $logger): ServiceContextBuilder {
        $this->loggerFactory = $logger;
        return $this;
    }

}
