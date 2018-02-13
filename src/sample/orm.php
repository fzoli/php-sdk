<?php
require_once __DIR__ . '/../autoload.php';

use App\Entity\Product;

$entityManager = \App\Services::Instance()->createEntityManager();

$product = new Product();
$product->setName('Product '.uniqid());

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . PHP_EOL;
