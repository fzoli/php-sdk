<?php

namespace App\Service\Product;

/**
 * Product service.
 * @package App\Service\Product
 */
interface ProductService {

    /**
     * @return ProductList
     * @throws \Exception
     */
    public function findAll(): ProductList;

    /**
     * @param string $name product name
     * @return Product
     * @throws \Exception
     */
    public function findOneByName(string $name): Product;

    public function createProduct(ProductCreateRequest $request): Product;

    public function updateProduct(ProductUpdateRequest $request): Product;

    public function deleteProduct(int $productId): void;

}
