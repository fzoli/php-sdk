<?php

namespace App\Api;

use App\Common\Config\Config;
use App\Context\RestServiceContextProvider;
use App\Service\DefaultServiceContainer;
use App\Service\Product\ProductService;
use App\Service\ServiceContainer;
use Doctrine\ORM\EntityManager;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Serializer\Serializer;

class Services implements ServiceContainer {

    /**
     * Singleton instance.
     * @var Services
     */
    private static $instance = null;

    private $container;

    public static function Instance(): Services {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    private function __clone() {
        // Singleton
    }

    private function __construct() {
        // Singleton
        $contextProvider = new RestServiceContextProvider();
        $context = $contextProvider->createServiceContext();
        $this->container = new DefaultServiceContainer($context);
    }

    public function getConfig(): Config {
        return $this->container->getConfig();
    }

    public function getCache(): CacheInterface {
        return $this->container->getCache();
    }

    public function getSerializer(): Serializer {
        return $this->container->getSerializer();
    }

    public function getEntityManager(): EntityManager {
        return $this->container->getEntityManager();
    }

    public function getProductService(): ProductService {
        return $this->container->getProductService();
    }

}

?>