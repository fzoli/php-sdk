<?php
require_once __DIR__ . '/../autoload.php';

use App\Service\Product\ProductCreateRequest;
use App\Services;

$service = Services::Instance()->createProductService();
$product = $service->createProduct(ProductCreateRequest::builder()
    ->setName('Product '.uniqid()));
echo "Created Product with ID " . $product->getId() . PHP_EOL;
