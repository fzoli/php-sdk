<?php

namespace App\Service;

use App\Common\Config\Config;
use App\Service\Product\ProductService;
use Doctrine\ORM\EntityManager;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Serializer\Serializer;

class DefaultServiceContainer implements ServiceContainer {

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

    public function __construct(ServiceContext $context) {
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