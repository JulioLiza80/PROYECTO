<?php

namespace ContainerSzs3fc0;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDetallePedidoCrudControllerconfigureCrudService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.GLGWHcU.App\Controller\Admin\DetallePedidoCrudController::configureCrud()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.GLGWHcU.App\\Controller\\Admin\\DetallePedidoCrudController::configureCrud()'] = ($container->privates['.service_locator.GLGWHcU'] ?? $container->load('get_ServiceLocator_GLGWHcUService'))->withContext('App\\Controller\\Admin\\DetallePedidoCrudController::configureCrud()', $container);
    }
}
