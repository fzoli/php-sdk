<?php

namespace App\Service;

use App\Common\Config\Config;
use App\Service\Product\ProductService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Simple\MemcachedCache;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ServiceFactory {

    private $context;

    public function __construct(ServiceContext $context) {
        $this->context = $context;
    }

    public function createConfig(): Config {
        return $this->context->getConfigFactory()->createConfig();
    }

    public function createCache(Config $config): CacheInterface {
        $memcached = new \Memcached();
        $memcached->addServer($config->getMemcachedHost(), $config->getMemcachedPort());
        return new MemcachedCache($memcached);
    }

    public function createSerializer(): Serializer {
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

    public function createEntityManager(Config $appConfig): EntityManager {
        $entityManagerConfig = Setup::createAnnotationMetadataConfiguration(
            array(__DIR__ . '/../Database'),
            $appConfig->isDebugMode());
        $dbParams = array(
            'driver' => $appConfig->getDatabaseDriver(),
            'user' => $appConfig->getDatabaseUser(),
            'password' => $appConfig->getDatabasePassword(),
            'dbname' => $appConfig->getDatabaseDatabaseName(),
        );
        return EntityManager::create($dbParams, $entityManagerConfig);
    }

    public function createProductService(EntityManager $entityManager): ProductService {
        return new Product\ProductServiceImpl($this->context->getLoggerFactory(), $entityManager);
    }

}
