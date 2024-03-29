<?php
require_once __DIR__ . '/../bootstrap.php';

use App\Service\Product\ProductUpdateRequest;
use App\Api\Services;

$service = Services::Instance()->getProductService();
foreach ($service->findAll() as $product) {
    $result = $service->updateProduct(ProductUpdateRequest::builder()
        ->withId($product->getId())
        ->withName('Updated name'.uniqid())
        ->build());
    echo "Updated Product with ID " . $result->getId() . PHP_EOL;
}
