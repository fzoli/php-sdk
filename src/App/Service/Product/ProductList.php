<?php

namespace App\Service\Product;

class ProductList implements \IteratorAggregate {

    /**
     * @var Product[]
     */
    private $items;

    public function __construct(Product ...$items) {
        $this->items = $items;
    }

    /**
     * @return \Traversable|Product[]
     */
    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->items);
    }

    /**
     * @return Product[]
     */
    public function toArray(): array {
        return $this->items;
    }

}
