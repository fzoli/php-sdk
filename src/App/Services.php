<?php

namespace App;

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

class Services implements EntityManagerFactory {

    /* Singleton instance. */
    private static $instance = null;

    /* Lazily created instances. */
    private $entityManager;

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

    public function createEntityManager(): EntityManager {
        if (isset($this->entityManager)) {
            return $this->entityManager;
        }
        $appConfig = $this->getConfig();
        $entityManagerConfig = Setup::createAnnotationMetadataConfiguration(
            array(__DIR__.'/Entity'),
            $appConfig->isDebugMode());
        $dbParams = array(
            'driver'   => $appConfig->getDatabaseDriver(),
            'user'     => $appConfig->getDatabaseUser(),
            'password' => $appConfig->getDatabasePassword(),
            'dbname'   => $appConfig->getDatabaseDatabaseName(),
        );
        $this->entityManager = EntityManager::create($dbParams, $entityManagerConfig);
        return $this->entityManager;
    }

}

?>