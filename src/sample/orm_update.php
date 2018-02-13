<?php
require_once __DIR__ . '/../autoload.php';

$entityManager = \App\Services::Instance()->createEntityManager();

$productRepository = $entityManager->getRepository('App\Entity\Product');

/* @var $products App\Entity\Product[] */
$products = $productRepository->findAll();

foreach ($products as $product) {
    $product->setName('Updated name'.uniqid());
    echo "Updated Product with ID " . $product->getId() . PHP_EOL;
}
$entityManager->flush();
