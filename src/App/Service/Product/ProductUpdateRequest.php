<?php

namespace App\Service\Product;

/**
 * Immutable Product update request.
 * @package App\Service\Product
 */
class ProductUpdateRequest {

    static function builder(): ProductUpdateRequestBuilder {
        return new ProductUpdateRequestBuilder();
    }

    private $id;
    private $name;

    public function __construct(ProductUpdateRequestBuilder $builder) {
        $this->id = $builder->getId();
        $this->name = $builder->getName();
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

}

class ProductUpdateRequestBuilder {

    private $id;
    private $name;

    public function __construct() {
    }

    public function build(): ProductUpdateRequest {
        return new ProductUpdateRequest($this);
    }

    public function getId(): int {
        return $this->id;
    }

    public function withId(int $id): ProductUpdateRequestBuilder {
        $this->id = $id;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function withName(string $name): ProductUpdateRequestBuilder {
        $this->name = $name;
        return $this;
    }

}
