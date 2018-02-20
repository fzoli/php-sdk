<?php

namespace App\Api;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel;

class ApiKernel extends Kernel {

    public function __construct() {
        $debug = true;
        $environment = 'sample';
        parent::__construct($environment, $debug);
    }

    /**
     * Returns an array of bundles to register.
     *
     * @return BundleInterface[] An array of bundle instances
     */
    public function registerBundles() {
        // TODO: Implement registerBundles() method.
    }

    /**
     * Loads the container configuration.
     */
    public function registerContainerConfiguration(LoaderInterface $loader) {
        // TODO: Implement registerContainerConfiguration() method.
    }

}
