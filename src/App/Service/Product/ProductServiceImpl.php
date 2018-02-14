<?php

namespace App\Service\Product;

use App\Service\EntityNotFoundException;
use App\Database\ProductEntity;
use App\Service\LoggerFactory;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;

/**
 * Product service.
 * @package App\Service\Product
 */
class ProductServiceImpl implements ProductService {

    private $logger;
    private $entityManager;
    private $repo;

    public function __construct(LoggerFactory $loggerFactory, EntityManager $entityManager) {
        $this->logger = $loggerFactory->createLogger('ProductServiceImpl');
        $this->entityManager = $entityManager;
        $this->repo = $entityManager->getRepository('\App\Database\ProductEntity');
    }

    /**
     * @return ProductList
     * @throws \Exception
     */
    public function findAll(): ProductList {
        $this->logger->log(Logger::DEBUG, 'findAll');
        $this->entityManager->beginTransaction();
        try {
            $result = $this->toPublicList($this->repo->findAll());
            $this->entityManager->commit();
            return $result;
        } catch (\Exception $e) {
            $this->entityManager->rollBack();
            throw $e;
        }
    }

    /**
     * @param string $name product name
     * @return Product
     * @throws \Exception
     */
    public function findOneByName(string $name): Product {
        $this->logger->log(Logger::DEBUG, 'findOneByName', [$name]);
        $this->entityManager->beginTransaction();
        try {
            /** @var $entity ProductEntity */
            $entity = $this->repo->findOneBy(array('name' => $name));
            if (!$entity) {
                throw new EntityNotFoundException();
            }
            $result = $this->toPublic($entity);
            $this->entityManager->commit();
            return $result;
        } catch (\Exception $e) {
            $this->entityManager->rollBack();
            throw $e;
        }
    }

    public function createProduct(ProductCreateRequest $request): Product {
        $this->logger->log(Logger::DEBUG, 'createProduct');
        $this->entityManager->beginTransaction();
        try {
            $entity = new ProductEntity();
            $entity->setCreateTime(new \DateTime());
            $entity->setName($request->getName());
            $this->entityManager->persist($entity);
            $this->entityManager->flush($entity);
            $result = $this->toPublic($entity); // Read back before commit to prevent store unreadable entity.
            $this->entityManager->commit();
            return $result;
        } catch (\Exception $e) {
            $this->entityManager->rollBack();
            throw $e;
        }
    }

    public function updateProduct(ProductUpdateRequest $request): Product {
        $this->logger->log(Logger::DEBUG, 'updateProduct');
        $this->entityManager->beginTransaction();
        try {
            /** @var $entity ProductEntity */
            $entity = $this->repo->findOneBy(array('id' => $request->getId()));
            if (!$entity) {
                throw new EntityNotFoundException();
            }
            $entity->setName($request->getName());
            $this->entityManager->flush($entity);
            $result = $this->toPublic($entity); // Read back before commit to prevent store unreadable entity.
            $this->entityManager->commit();
            return $result;
        } catch (\Exception $e) {
            $this->entityManager->rollBack();
            throw $e;
        }
    }

    public function deleteProduct(int $productId): void {
        $this->logger->log(Logger::DEBUG, 'deleteProduct', [$productId]);
        $this->entityManager->beginTransaction();
        try {
            /** @var $entity ProductEntity */
            $entity = $this->repo->findOneBy(array('id' => $productId));
            if (!$entity) {
                throw new EntityNotFoundException();
            }
            $this->entityManager->remove($entity);
            $this->entityManager->flush($entity);
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollBack();
            throw $e;
        }
    }

    private function toPublic(ProductEntity $entity): Product {
        return Product::builder()
            ->withId($entity->getId())
            ->withVersion($entity->getVersion())
            ->withName($entity->getName())
            ->build();
    }

    /**
     * @param ProductEntity[] $entities
     * @return ProductList
     */
    private function toPublicList(array $entities): ProductList {
        $items = [];
        foreach ($entities as $entity) {
            $items[] = $this->toPublic($entity);
        }
        return new ProductList(...$items);
    }

}
