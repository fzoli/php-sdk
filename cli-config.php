<?php
require_once __DIR__ . '/src/bootstrap.php';

use App\Api\Services;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$entityManager = Services::Instance()->getEntityManager();
return ConsoleRunner::createHelperSet($entityManager);
