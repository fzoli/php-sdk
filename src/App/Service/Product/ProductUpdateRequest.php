<?php

namespace App\Service\Product;

class ProductUpdateRequest {

    static function builder(): ProductUpdateRequest {
        return new ProductUpdateRequest();
    }

    private $id;
    private $name;

    private function __construct() {
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): ProductUpdateRequest {
        $this->id = $id;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): ProductUpdateRequest {
        $this->name = $name;
        return $this;
    }

}
