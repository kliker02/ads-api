<?php


namespace Kliker02\VcruTask;


use Kliker02\VcruTask\Config\ConfigInterface;
use Laminas\Router\RoutePluginManager;
use Laminas\ServiceManager\ServiceManager;

/**
 * @author Alex Tokunov
 * Class RouterFactory
 * @package Kliker02\VcruTask
 */
class RouterFactory
{
    public function __invoke(ServiceManager $ServiceManager, ConfigInterface $Config) {
        $routes = [];

        if (!isset($Config->getConfig()['router']) || !isset($Config->getConfig()['router']['routes']) || !is_array($Config->getConfig()['router']['routes'])) {
            throw new \Exception('Invalid routes config');
        }

        $routes = $Config->getConfig()['router']['routes'];
        $RouterManager = new RoutePluginManager($ServiceManager);
        $Router = new \Laminas\Router\SimpleRouteStack($RouterManager);
        $Router->addRoutes($routes);

        return $Router;
    }

}