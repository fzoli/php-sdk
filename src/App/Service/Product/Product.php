<?php

namespace App\Service\Product;

/**
 * Immutable Product.
 * @package App\Service\Product
 */
class Product {

    static function builder(): ProductBuilder {
        return new ProductBuilder();
    }

    private $id;
    private $version;
    private $name;

    public function __construct(ProductBuilder $builder) {
        $this->id = $builder->getId();
        $this->version = $builder->getVersion();
        $this->name = $builder->getName();
    }

    public function getId(): int {
        return $this->id;
    }

    public function getVersion(): int {
        return $this->version;
    }

    public function getName(): string {
        return $this->name;
    }

}

class ProductBuilder {

    private $id;
    private $version;
    private $name;

    public function __construct() {
    }

    public function build(): Product {
        return new Product($this);
    }

    public function getId(): int {
        return $this->id;
    }

    public function withId(int $id): ProductBuilder {
        $this->id = $id;
        return $this;
    }

    public function getVersion(): int {
        return $this->version;
    }

    public function withVersion(int $version): ProductBuilder {
        $this->version = $version;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function withName(string $name): ProductBuilder {
        $this->name = $name;
        return $this;
    }

}
