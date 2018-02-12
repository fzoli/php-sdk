<?php

namespace App;

use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Cache\Simple\MemcachedCache;

class Services {

    private static $instance = null;

    private $config;
    private $cache;

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
        $this->config = $config;
        $this->cache = $cache;
    }

    public function getConfig(): Config {
        return $this->config;
    }

    public function getCache(): CacheInterface {
        return $this->cache;
    }

    private function createConfig(): Config {
        return new Config(Yaml::parseFile(__DIR__ . '/../../config.yaml'));
    }

    private function createCache(Config $config): CacheInterface {
        $memcached = new \Memcached();
        $memcached->addServer($config->getMemcachedHost(), $config->getMemcachedPort());
        return new MemcachedCache($memcached);
    }

}

?>