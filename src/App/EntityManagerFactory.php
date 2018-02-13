<?php

namespace App;

use Doctrine\ORM\EntityManager;

interface EntityManagerFactory {
    public function createEntityManager(): EntityManager;
}
