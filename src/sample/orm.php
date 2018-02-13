<?php
require_once __DIR__ . '/../autoload.php';

use App\Entity\Product;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$cfg = \App\Services::Instance()->getConfig();

// Create a simple "default" Doctrine ORM configuration for Annotations
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__.'/../App/Entity'), $cfg->isDebugMode());

// database configuration parameters
$dbParams = array(
    'driver'   => $cfg->getDatabaseDriver(),
    'user'     => $cfg->getDatabaseUser(),
    'password' => $cfg->getDatabasePassword(),
    'dbname'   => $cfg->getDatabaseDatabaseName(),
);

// obtaining the entity manager
$entityManager = EntityManager::create($dbParams, $config);

$product = new Product();
$product->setName('Product '.uniqid());

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . PHP_EOL;
