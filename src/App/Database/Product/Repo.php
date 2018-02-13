<?php

namespace App\Database\Product;

use Doctrine\ORM\EntityManager;

class Repo {

    private $entityManager;
    private $repo;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        $this->repo = $entityManager->getRepository('\App\Database\Product\Entity');
    }

    /**
     * @return Entity[] list of products
     */
    public function findAll(): array {
        return $this->repo->findAll();
    }

    /**
     * @param string $name product name
     * @return Entity
     * @throws \App\Database\EntityNotFoundException
     */
    public function findOneByName(string $name): Entity {
        /** @var $r Entity */
        $r = $this->repo->findOneBy(array('name' => $name));
        if (!$r) {
            throw new \App\Database\EntityNotFoundException();
        }
        return $r;
    }

}
