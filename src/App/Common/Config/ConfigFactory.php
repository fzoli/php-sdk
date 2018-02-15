<?php

namespace App\Common\Config;

interface ConfigFactory {
    public function createConfig(): Config;
}
