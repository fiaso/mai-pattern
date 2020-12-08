<?php

namespace Framework;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\Routing\RouteCollection;

class Register
{
    /**
     * @var string
     */
    private $dir;
    /**
     * @var RouteCollection
     */
    protected $routeCollection;

    /**
     * @var ContainerBuilder
     */
    protected $containerBuilder;

    public function __construct(string $dir, ContainerBuilder $containerBuilder)
    {
        $this->dir = $dir;
        $this->containerBuilder = $containerBuilder;
    }

    /**
     * @return RouteCollection
     */
    public function registerRoutes(): RouteCollection
    {
        $this->routeCollection = require $this->dir . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routing.php';
        return $this->routeCollection;
    }

    /**
     * @return ContainerBuilder
     */
    public function setContainerBuilder(): ContainerBuilder
    {
        $this->containerBuilder->set('route_collection', $this->routeCollection);
        return $this->containerBuilder;
    }

    /**
     * @return ContainerBuilder
     */
    public function registerConfigs(): ContainerBuilder
    {
        $fileLocator = new FileLocator($this->dir . DIRECTORY_SEPARATOR . 'config');
        $loader = new PhpFileLoader($this->containerBuilder, $fileLocator);
        $loader->load('parameters.php');
        return $this->containerBuilder;
    }
}