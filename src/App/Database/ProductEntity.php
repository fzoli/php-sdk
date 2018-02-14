<?php

namespace App\Database;

/**
 * @Entity
 * @Table(name="products")
 */
class ProductEntity {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     **/
    private $id;

    /**
     * @Version
     * @Column(type="integer")
     * @var int
     **/
    private $version;

    /**
     * @Column(type="string")
     * @var string
     **/
    private $name;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $createTime;

    public function getId(): int {
        return $this->id;
    }

    public function getVersion(): int {
        return $this->version;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getCreateTime(): \DateTime {
        return $this->createTime;
    }

    public function setCreateTime(\DateTime $createTime) {
        $this->createTime = $createTime;
    }

}
