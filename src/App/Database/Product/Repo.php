<?php

namespace App\Database\Product;

use Doctrine\ORM\EntityManager;

class Repo {

    private $entityManager;
    private $repo;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        $this->repo = $entityManager->getRepository('App\Database\Product\Entity');
    }

    /**
     * @return Entity[] list of products
     */
    public function findAll() {
        return $this->repo->findAll();
    }

}
