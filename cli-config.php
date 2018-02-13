<?php
require_once __DIR__ . '/src/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$entityManager = \App\Services::Instance()->createEntityManager();
return ConsoleRunner::createHelperSet($entityManager);
