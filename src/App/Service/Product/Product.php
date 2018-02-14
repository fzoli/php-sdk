<?php

namespace App\Service\Product;

class Product {

    static function builder(): Product {
        return new Product();
    }

    private $id;
    private $version;
    private $name;

    private function __construct() {
    }

    public function getId(): int {
        return $this->id;
    }

    function setId(int $id): Product {
        $this->id = $id;
        return $this;
    }

    public function getVersion(): int {
        return $this->version;
    }

    function setVersion(int $version): Product {
        $this->version = $version;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    function setName(string $name): Product {
        $this->name = $name;
        return $this;
    }

}
