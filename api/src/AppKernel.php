<?php
namespace App;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class AppKernel extends Kernel
{
    use MicroKernelTrait;

    /**
     * @return iterable|FrameworkBundle[]|BundleInterface[]
     */
    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
        ];
    }

    /**
     * @param RouteCollectionBuilder $routes
     * @throws \Symfony\Component\Config\Exception\LoaderLoadException
     */
    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $confDir = $this->getProjectDir().'/config';
        $routes->import($confDir.'/routes.yaml' );
    }

    /**
     * @param ContainerBuilder $c
     * @param LoaderInterface $loader
     * @throws \Exception
     */
    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $confDir = $this->getProjectDir().'/config';
        $loader->load($confDir.'/services.php');
    }
}
