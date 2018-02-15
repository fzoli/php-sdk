<?php

namespace App\Api;

use App\Common\Config;
use App\Context\RestServiceContextProvider;
use App\Service\Product\ProductService;
use App\Service\ServiceFactory;
use Doctrine\ORM\EntityManager;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Serializer\Serializer;

class Services {

    /**
     * Singleton instance.
     * @var Services
     */
    private static $instance = null;

    /* Lazily created instances. */

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var \App\Service\Product\ProductService
     */
    private $productService;

    /* Instances created in constructor. */

    private $serviceFactory;
    private $config;
    private $cache;
    private $serializer;

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
        $serviceFactory = new ServiceFactory($context);
        $config = $serviceFactory->createConfig();
        $cache = $serviceFactory->createCache($config);
        $serializer = $serviceFactory->createSerializer();
        $this->serviceFactory = $serviceFactory;
        $this->config = $config;
        $this->cache = $cache;
        $this->serializer = $serializer;
    }

    public function getConfig(): Config {
        return $this->config;
    }

    public function getCache(): CacheInterface {
        return $this->cache;
    }

    public function getSerializer(): Serializer {
        return $this->serializer;
    }

    public function getEntityManager(): EntityManager {
        if (isset($this->entityManager)) {
            return $this->entityManager;
        }
        $this->entityManager = $this->serviceFactory->createEntityManager(
            $this->getConfig());
        return $this->entityManager;
    }

    public function getProductService(): ProductService {
        if (isset($this->productService)) {
            return $this->productService;
        }
        $this->productService = $this->serviceFactory->createProductService(
            $this->getEntityManager());
        return $this->productService;
    }

}

?>