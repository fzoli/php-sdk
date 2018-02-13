<?php

namespace App\Database\Product;

/**
 * @Entity
 * @Table(name="products")
 */
class Entity {

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

    public function getVersion(): int {
        return $this->version;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

}
