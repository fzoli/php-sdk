<?php
require_once __DIR__ . '/../bootstrap.php';

use App\Service\Product\ProductCreateRequest;
use App\Api\Services;

$service = Services::Instance()->getProductService();
$product = $service->createProduct(ProductCreateRequest::builder()
    ->withName('Product '.uniqid())
    ->build());
echo "Created Product with ID " . $product->getId() . PHP_EOL;
