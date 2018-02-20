<?php

namespace App\Api;

use App\Common\Config\YamlConfigFactory;
use App\Service\ServiceContext;

class ApiServiceContextProvider {

    public function createServiceContext(): ServiceContext {
        return ServiceContext::builder()
            ->withLoggerFactory(new ApiLoggerFactory())
            ->withConfigFactory(new YamlConfigFactory())
            ->build();
    }

}
