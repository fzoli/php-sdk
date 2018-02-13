<?php
require_once __DIR__ . '/../autoload.php';

$entityManager = \App\Services::Instance()->createEntityManager();
$repo = \App\Services::Instance()->createProductRepo();

foreach ($repo->findAll() as $product) {
    $product->setName('Updated name'.uniqid());
    echo "Updated Product with ID " . $product->getId() . PHP_EOL;
}
$entityManager->flush();
