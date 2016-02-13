<?php

namespace rootLogin\DemoApp;

use Silex\Application;
use Saxulum\BundleProvider\Provider\AbstractBundleProvider;

class DemoApp extends AbstractBundleProvider
{
    public function register(Application $app)
    {
        $this->addTwigLoaderFilesystemPath($app);
        $this->addControllers($app);
    }

    public function boot(Application $app) {}
}