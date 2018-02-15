<?php

namespace App\Service;

use App\Common\Config\Config;
use App\Service\Product\ProductService;
use Doctrine\ORM\EntityManager;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Serializer\Serializer;

interface ServiceContainer {

    public function getConfig(): Config;

    public function getCache(): CacheInterface;

    public function getSerializer(): Serializer;

    public function getEntityManager(): EntityManager;

    public function getProductService(): ProductService;

}

?>