<?php
require_once __DIR__ . '/../autoload.php';

use App\Service\Product\ProductUpdateRequest;
use App\Services;

$service = Services::Instance()->createProductService();
foreach ($service->findAll() as $product) {
    $result = $service->updateProduct(ProductUpdateRequest::builder()
        ->setId($product->getId())
        ->setName('Updated name'.uniqid()));
    echo "Updated Product with ID " . $result->getId() . PHP_EOL;
}
