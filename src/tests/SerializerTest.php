<?php
declare(strict_types=1);

use App\Api\Services;
use PHPUnit\Framework\TestCase;

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

    public function getCreateDate(): DateTimeImmutable {
        return $this->createDate;
    }

    public function setCreateDate(DateTimeImmutable $createDate): User {
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

final class SerializerTest extends TestCase {

    public function testUserJsonSerialize(): void {
        $s = Services::Instance()->getSerializer();
        $createDate = new DateTimeImmutable();
        $user = User::builder()
            ->setName("Zoli")
            ->setPersonName(PersonName::builder()
                ->setFirstName("A")
                ->setLastName("B"))
            ->setCreateDate($createDate);

        $json = $s->serialize(array($user), 'json');

        $createDate->setTimezone(new DateTimeZone('UTC'));
        $createDateText = $createDate->format(DateTime::ISO8601);
        $expectedJson = '[{"name":"Zoli","personName":{"firstName":"A","lastName":"B"},"createDate":"'.$createDateText.'"}]';

        $this->assertEquals($expectedJson, $json);
    }

}
