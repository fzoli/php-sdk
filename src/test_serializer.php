#!/usr/bin/php
<?php
require_once __DIR__ . '/autoload.php';

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class User {

    private $name;
    private $createDate;

    public static function createSerializer(): Serializer {
        $encoders = array(new JsonEncoder(), new XmlEncoder());
        $normalizer = new GetSetMethodNormalizer();

        $callback = function ($dateTime) {
            return $dateTime instanceof \DateTime
                ? $dateTime->format(\DateTime::ISO8601)
                : '';
        };

        $normalizer->setCallbacks(array('createDate' => $callback));

        return new Serializer(array($normalizer), $encoders);
    }

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

$user = User::builder()
    ->setName("Zoli")
    ->setCreateDate(new DateTime());

$jsonContent = User::createSerializer()->serialize($user, 'json');
echo $jsonContent;

?>
