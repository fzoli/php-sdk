<?php

namespace App\Service;

use App\Common\Config\ConfigFactory;

/**
 * Immutable Service context.
 * @package App\Service
 */
class ServiceContext {

    static function builder(): ServiceContextBuilder {
        return new ServiceContextBuilder();
    }

    private $loggerFactory;
    private $configFactory;

    public function __construct(ServiceContextBuilder $builder) {
        $this->loggerFactory = $builder->getLoggerFactory();
        $this->configFactory = $builder->getConfigFactory();
    }

    public function getLoggerFactory(): LoggerFactory {
        return $this->loggerFactory;
    }

    public function getConfigFactory(): ConfigFactory {
        return $this->configFactory;
    }

}

class ServiceContextBuilder {

    private $loggerFactory;
    private $configFactory;

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

    public function getConfigFactory(): ConfigFactory {
        return $this->configFactory;
    }

    public function withConfigFactory(ConfigFactory $logger): ServiceContextBuilder {
        $this->configFactory = $logger;
        return $this;
    }

}
