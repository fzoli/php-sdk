<?php

namespace App\Context;

use App\Service\ServiceContext;

interface ServiceContextProvider {
    public function createServiceContext(): ServiceContext;
}
