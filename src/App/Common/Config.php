<?php

namespace App\Common;

class Config {

    private const LV1_DEBUG_MODE = 'debug_mode';
    private const LV1_DATABASE = 'database';
    private const LV1_MEMCACHED = 'memcached';

    private const LV2_DATABASE_DRIVER = 'driver';
    private const LV2_DATABASE_USER = 'user';
    private const LV2_DATABASE_PASSWORD = 'password';
    private const LV2_DATABASE_DATABASE_NAME = 'database_name';
    private const LV2_MEMCACHED_HOST = 'host';
    private const LV2_MEMCACHED_PORT = 'port';

    private $array;

    public function __construct($array) {
        $this->array = $array;
    }

    public function isDebugMode(): bool {
        return $this->array[self::LV1_DEBUG_MODE];
    }

    public function getDatabaseDriver(): string {
        return $this->array[self::LV1_DATABASE][self::LV2_DATABASE_DRIVER];
    }

    public function getDatabaseUser(): string {
        return $this->array[self::LV1_DATABASE][self::LV2_DATABASE_USER];
    }

    public function getDatabasePassword(): string {
        return $this->array[self::LV1_DATABASE][self::LV2_DATABASE_PASSWORD];
    }

    public function getDatabaseDatabaseName(): string {
        return $this->array[self::LV1_DATABASE][self::LV2_DATABASE_DATABASE_NAME];
    }

    public function getMemcachedHost(): string {
        return $this->array[self::LV1_MEMCACHED][self::LV2_MEMCACHED_HOST];
    }

    public function getMemcachedPort(): int {
        return $this->array[self::LV1_MEMCACHED][self::LV2_MEMCACHED_PORT];
    }

}

?>