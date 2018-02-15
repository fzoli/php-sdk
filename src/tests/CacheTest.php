<?php
declare(strict_types=1);

use App\Api\Services;
use PHPUnit\Framework\TestCase;

final class CacheTest extends TestCase {

    public function testCacheCRUD(): void {
        $key = uniqid('cache_test_');
        $cache = Services::Instance()->getCache();

        $this->assertFalse($cache->has($key));
        $this->assertNull($cache->get($key));

        $cache->set($key, 'Hello cache');

        $this->assertTrue($cache->has($key));
        $this->assertEquals('Hello cache', $cache->get($key));

        $cache->delete($key);

        $this->assertFalse($cache->has($key));
        $this->assertNull($cache->get($key));
    }

}
