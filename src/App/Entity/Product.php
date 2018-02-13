<?php

namespace App\Entity;

/**
 * @Entity
 * @Table(name="products")
 */
class Product {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     **/
    private $id;

    /**
     * @Version
     * @Column(type="integer") */
    private $version;

    /**
     * @Column(type="string")
     **/
    private $name;

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

}
