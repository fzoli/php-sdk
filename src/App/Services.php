<?php

namespace App;

use App\Service\Product\ProductService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Cache\Simple\MemcachedCache;

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
     * @var Service\Product\ProductService
     */
    private $productService;

    /* Instances created in constructor. */

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
        $config = $this->createConfig();
        $cache = $this->createCache($config);
        $serializer = $this->createSerializer();
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
        $this->entityManager = $this->createEntityManager(
            $this->getConfig());
        return $this->entityManager;
    }

    public function getProductService(): ProductService {
        if (isset($this->productService)) {
            return $this->productService;
        }
        $this->productService = $this->createProductService(
            $this->getEntityManager());
        return $this->productService;
    }

    private function createConfig(): Config {
        return new Config(Yaml::parseFile(__DIR__ . '/../../config.yaml'));
    }

    private function createCache(Config $config): CacheInterface {
        $memcached = new \Memcached();
        $memcached->addServer($config->getMemcachedHost(), $config->getMemcachedPort());
        return new MemcachedCache($memcached);
    }

    private function createSerializer(): Serializer {
        return new Serializer(
            array(
                new DateTimeNormalizer(\DateTime::ISO8601, new \DateTimeZone("UTC")),
                new ObjectNormalizer()
            ),
            array(
                new JsonEncoder(),
                new XmlEncoder(),
                new CsvEncoder(),
                new YamlEncoder()
            )
        );
    }

    private function createEntityManager(Config $appConfig): EntityManager {
        $entityManagerConfig = Setup::createAnnotationMetadataConfiguration(
            array(__DIR__ . '/Database'),
            $appConfig->isDebugMode());
        $dbParams = array(
            'driver' => $appConfig->getDatabaseDriver(),
            'user' => $appConfig->getDatabaseUser(),
            'password' => $appConfig->getDatabasePassword(),
            'dbname' => $appConfig->getDatabaseDatabaseName(),
        );
        return EntityManager::create($dbParams, $entityManagerConfig);
    }

    private function createProductService(EntityManager $entityManager): ProductService {
        return new ProductService($entityManager);
    }

}

?>