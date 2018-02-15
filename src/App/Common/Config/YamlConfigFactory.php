<?php

namespace App\Common\Config;

use Symfony\Component\Yaml\Yaml;

class YamlConfigFactory implements ConfigFactory {

    public function createConfig(): Config {
        return new Config(Yaml::parseFile(__DIR__ . '/../../../../config.yaml'));
    }

}
