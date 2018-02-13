#!/usr/bin/php
<?php
require_once __DIR__ . '/autoload.php';

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class User {

    private $name;
    private $createDate;

    public static function builder(): User {
        return new User();
    }

    private function __construct() {
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): User {
        $this->name = $name;
        return $this;
    }

    public function getCreateDate(): DateTime {
        return $this->createDate;
    }

    public function setCreateDate(DateTime $createDate): User {
        $this->createDate = $createDate;
        return $this;
    }

}

$s = new Serializer(
    array(
        new DateTimeNormalizer(\DateTime::ISO8601, new DateTimeZone("UTC")),
        new ObjectNormalizer()
    ),
    array(
        new JsonEncoder(),
        new XmlEncoder()
    )
);

$user1 = User::builder()
    ->setName("Zoli")
    ->setCreateDate(new DateTime());

$user2 = User::builder()
    ->setName("Zoli")
    ->setCreateDate(new DateTime());

$jsonContent = $s->serialize(array($user1, $user2), 'json');
echo $jsonContent;

?>
