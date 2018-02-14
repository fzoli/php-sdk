<?php

namespace App\Service\Product;

/**
 * Immutable Product create request.
 * @package App\Service\Product
 */
class ProductCreateRequest {

    static function builder(): ProductCreateRequestBuilder {
        return new ProductCreateRequestBuilder();
    }

    private $name;

    public function __construct(ProductCreateRequestBuilder $builder) {
        $this->name = $builder->getName();
    }

    public function getName(): string {
        return $this->name;
    }

}

class ProductCreateRequestBuilder {

    private $name;

    public function __construct() {
    }

    public function build(): ProductCreateRequest {
        return new ProductCreateRequest($this);
    }

    public function getName(): string {
        return $this->name;
    }

    public function withName(string $name): ProductCreateRequestBuilder {
        $this->name = $name;
        return $this;
    }

}
