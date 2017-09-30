<?php
$containerBuilder = require __DIR__ . '/../bootstrap.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\XmlFileLoader;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Response;

try {
    $locator = new FileLocator(array(__DIR__));
    $requestContext = new RequestContext('/');

    $router = new Router(
        new XmlFileLoader($locator),
        __DIR__ . '/../di/routes.xml',
        [],
        $requestContext
    );

    $request = Request::createFromGlobals();
    $request->attributes
        ->add($router->matchRequest($request));

    list($controllerId, $action) = explode(':', $router->matchRequest($request)['_controller']);

    $controller = $containerBuilder->get($controllerId);

    $argumentResolver = new ArgumentResolver();
    $arguments = $argumentResolver->getArguments($request, [get_class($controller), $action]);

    $response = call_user_func_array([$controller, $action], $arguments);
    $response->send();
} catch (ResourceNotFoundException $e) {
    return (new Response('Not Found', 404))->send();
} catch (\Exception $e) {
    throw $e;
}
