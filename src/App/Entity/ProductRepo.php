<?php

namespace App\Entity;

use Doctrine\ORM\EntityManager;

class ProductRepo {

    private $entityManager;
    private $repo;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        $this->repo = $entityManager->getRepository('App\Entity\Product');
    }

    /**
     * @return Product[] list of products
     */
    public function findAll() {
        return $this->repo->findAll();
    }

}
