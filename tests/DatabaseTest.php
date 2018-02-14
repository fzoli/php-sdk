<?php
declare(strict_types=1);

use App\Service\Product\ProductCreateRequest;
use App\Service\Product\ProductUpdateRequest;
use PHPUnit\Framework\TestCase;

final class DatabaseTest extends TestCase {

    public function testDatabaseCRUD(): void {
        $service = \App\Services::Instance()->createProductService();

        // Create
        $name = uniqid('database_test_');
        $product = $service->createProduct(ProductCreateRequest::builder()
            ->withName($name)
            ->build());
        $this->assertTrue($product->getId() > 0);
        $this->assertEquals(1, $product->getVersion());
        $this->assertEquals($name, $product->getName());

        // Read
        $read = $service->findOneByName($name);
        $this->assertEquals($product->getId(), $read->getId());
        $this->assertEquals($name, $read->getName());

        // Update
        $service->updateProduct(ProductUpdateRequest::builder()
            ->withId($product->getId())
            ->withName($name.' updated')
            ->build());

        // Delete
        $service->deleteProduct($product->getId());
    }

    public function testDatabaseEntityNotFoundException(): void {
        $this->expectException("\App\Service\EntityNotFoundException");
        $service = \App\Services::Instance()->createProductService();
        $name = uniqid('database_test_none_');
        $service->findOneByName($name);
    }

}
