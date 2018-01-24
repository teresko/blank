<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/functions.php';



$request = Request::createFromGlobals();

$locator = new FileLocator(__DIR__ . '/../config');

// DI container
$container = new DependencyInjection\ContainerBuilder;
$container->setParameter('path.root', __DIR__);

$resolver = new LoaderResolver(
    [
        new YamlFileLoader($container, $locator),
        new PhpFileLoader($container, $locator),
    ]
);
$loader = new DelegatingLoader($resolver);
$loader->load('config-development.yml');

$container->compile();


// routing
$loader = new Routing\Loader\YamlFileLoader($locator);
$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher(
    $loader->load('routing.yml'),
    $context
);

$parameters = $matcher->match($request->getPathInfo());

foreach ($parameters as $key => $value) {
    $request->attributes->set($key, $value);
}


$command = $request->getMethod() . $request->get('action');

try {
    $controller = $container->get('controller.' . $request->get('resource'));
    $controller->{$command}($request);

    $view = $container->get('view.' . $request->get('resource'));
    $response = $view->{$command}($request) ?? new Response;
} catch (\Model\Exception\AccessDenied $exception) {
    $response = new RedirectResponse('/login');
} catch (\Exception $exception) {
    var_dump($exception);
    $response = new Response($exception->getMessage());
} catch (\TypeError $error) {
    $response = new Response("Invalid dependency: {$error->getMessage()}");
}

$response->send();
