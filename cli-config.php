<?php
require_once __DIR__ . '/src/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$cfg = \App\Services::Instance()->getConfig();

// Create a Doctrine ORM configuration for Annotations
$config = Setup::createAnnotationMetadataConfiguration(
    array(
        __DIR__ . '/src/App/Entity'
    ),
    $cfg->isDebugMode());

// database configuration parameters
$dbParams = array(
    'driver'   => $cfg->getDatabaseDriver(),
    'user'     => $cfg->getDatabaseUser(),
    'password' => $cfg->getDatabasePassword(),
    'dbname'   => $cfg->getDatabaseDatabaseName(),
);

// obtaining the entity manager
$entityManager = EntityManager::create($dbParams, $config);

return ConsoleRunner::createHelperSet($entityManager);
