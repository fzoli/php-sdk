<?php

namespace App\Service\Product;

class ProductCreateRequest {

    static function builder(): ProductCreateRequest {
        return new ProductCreateRequest();
    }

    private $name;

    private function __construct() {
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): ProductCreateRequest {
        $this->name = $name;
        return $this;
    }

}
