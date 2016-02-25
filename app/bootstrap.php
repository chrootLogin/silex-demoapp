<?php

use Silex\Application;
use Saxulum\Console\Silex\Provider\ConsoleProvider;
use Saxulum\Translation\Silex\Provider\TranslationProvider;
use Saxulum\RouteController\Provider\RouteControllerProvider;
use Saxulum\DoctrineOrmManagerRegistry\Silex\Provider\DoctrineOrmManagerRegistryProvider;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\RememberMeServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Igorw\Silex\ConfigServiceProvider;
use rootLogin\DemoApp\DemoApp;
use rootLogin\UserProvider\Provider\UserProviderServiceProvider;
use rootLogin\UserProvider\Provider\UserProviderControllerProvider;
use Sorien\Provider\PimpleDumpProvider;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\ApcuCache;

// annotation registry
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

// create new silex app
$app = new Application();

$app['root'] = realpath(__DIR__ . "/..");
$app['debug'] = isset($debug) ? $debug : false;
$app['env'] = isset($env) ? $env : 'prod';

$app->register(new ConsoleProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new RouteControllerProvider());
$app->register(new SessionServiceProvider());
$app->register(new DoctrineServiceProvider());
$app->register(new DoctrineOrmServiceProvider());
$app->register(new DoctrineOrmManagerRegistryProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new TranslationServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new ValidatorServiceProvider(), [
    'validator.mapping.class_metadata_factory' => new LazyLoadingMetadataFactory(
        new AnnotationLoader(new AnnotationReader()),
        (extension_loaded('apc') ? new ApcuCache() : null)
    ),
]);
$app->register(new TwigServiceProvider());
$app->register(new SecurityServiceProvider());
$app->register(new RememberMeServiceProvider());
$app->register(new UserProviderServiceProvider());
$app->register(new SwiftmailerServiceProvider());

if($app['debug'] == true) {
    $app->register(new PimpleDumpProvider());
}

$app->register(new ConfigServiceProvider($app['root'] . "/app/config/config.yml", array(
    "root_dir" => $app['root'],
    "env" => $app['env']
)));
$app->register(new ConfigServiceProvider($app['root'] . "/app/config/parameters.yml", array(
    "root_dir" => $app['root'],
    "env" => $app['env']
)));

require_once($app['root'] . "/app/config/security.php");

$app->mount('/user', new UserProviderControllerProvider());
$app->register(new DemoApp());

return $app;