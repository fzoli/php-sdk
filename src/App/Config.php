<?php

namespace App;

class Config {

    private $array;

    public function __construct($array) {
        $this->array = $array;
    }

    public function getMemcachedHost(): string {
        return $this->array['memcached']['host'];
    }

    public function getMemcachedPort(): int {
        return $this->array['memcached']['port'];
    }

}

?>