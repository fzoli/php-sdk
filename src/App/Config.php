<?php

namespace App;

class Config {

    private $array;

    public function __construct($array) {
        $this->array = $array;
    }

    public function isDebugMode(): bool {
        return $this->array['debug_mode'];
    }

    public function getDatabaseDriver(): string {
        return $this->array['database']['driver'];
    }

    public function getDatabaseUser(): string {
        return $this->array['database']['user'];
    }

    public function getDatabasePassword(): string {
        return $this->array['database']['password'];
    }

    public function getDatabaseDatabaseName(): string {
        return $this->array['database']['database_name'];
    }

    public function getMemcachedHost(): string {
        return $this->array['memcached']['host'];
    }

    public function getMemcachedPort(): int {
        return $this->array['memcached']['port'];
    }

}

?>