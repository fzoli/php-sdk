<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class DatabaseTest extends TestCase {

    public function testDatabaseCRUD(): void {
        $entityManager = App\Services::Instance()->createEntityManager();
        $repo = App\Services::Instance()->createProductRepo();

        // Create
        $name = uniqid('database_test_');
        $entity = new App\Database\Product\Entity();
        $entity->setName($name);
        $entityManager->persist($entity);
        $entityManager->flush();
        $this->assertTrue($entity->getId() > 0);
        $this->assertEquals(1, $entity->getVersion());
        $this->assertEquals($name, $entity->getName());

        // Read
        $entityRead = $repo->findOneByName($name);
        $this->assertEquals($entity->getId(), $entityRead->getId());
        $this->assertEquals($name, $entityRead->getName());

        // Update
        $entityRead->setName($name.' updated');
        $entityManager->flush();

        // Delete
        $entityManager->remove($entity);
    }

    public function testDatabaseEntityNotFoundException(): void {
        $this->expectException("\App\Database\EntityNotFoundException");
        $repo = App\Services::Instance()->createProductRepo();
        $name = uniqid('database_test_none_');
        $repo->findOneByName($name);
    }

}
