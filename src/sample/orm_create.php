<?php
require_once __DIR__ . '/../autoload.php';

use App\Database\Product\Entity;

$entityManager = \App\Services::Instance()->createEntityManager();

$product = new Entity();
$product->setName('Product '.uniqid());

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . PHP_EOL;
