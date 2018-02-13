#!/usr/bin/php
<?php
require_once __DIR__ . '/autoload.php';

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class User {

    private $name;
    private $personName;
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

    public function getPersonName(): PersonName {
        return $this->personName;
    }

    public function setPersonName(PersonName $name): User {
        $this->personName = $name;
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

class PersonName {

    private $firstName;
    private $lastName;

    public static function builder(): PersonName {
        return new PersonName();
    }

    private function __construct() {
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function setFirstName(string $name): PersonName {
        $this->firstName = $name;
        return $this;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function setLastName(string $name): PersonName {
        $this->lastName = $name;
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
        new XmlEncoder(),
        new CsvEncoder(),
        new YamlEncoder()
    )
);

$user1 = User::builder()
    ->setName("Zoli")
    ->setPersonName(PersonName::builder()
        ->setFirstName("A")
        ->setLastName("B"))
    ->setCreateDate(new DateTime());

echo 'JSON:'.PHP_EOL;
echo $s->serialize(array($user1), 'json');
echo PHP_EOL.PHP_EOL;

echo 'XML:'.PHP_EOL;
echo $s->serialize(array($user1), 'xml');
echo PHP_EOL.PHP_EOL;

echo 'CSV:'.PHP_EOL;
echo $s->serialize(array($user1), 'csv');
echo PHP_EOL.PHP_EOL;

echo 'YAML:'.PHP_EOL;
echo $s->serialize(array($user1), 'yaml');
echo PHP_EOL.PHP_EOL;

?>
