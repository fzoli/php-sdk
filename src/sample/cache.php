#!/usr/bin/php
<?php
require_once __DIR__ . '/../autoload.php';

use App\Services;

$key = 'a';
$cache = Services::Instance()->getCache();
if ($cache->has($key)) {
    $cache->set($key, $cache->get($key) + 1);
} else {
    $cache->set($key, 1);
}
print $cache->get($key);

?>
