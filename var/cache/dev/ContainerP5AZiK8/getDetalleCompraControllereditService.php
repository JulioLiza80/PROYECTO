<?php

namespace ContainerP5AZiK8;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDetalleCompraControllereditService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.xEjFHUz.App\Controller\DetalleCompraController::edit()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        $a = ($container->privates['.service_locator.xEjFHUz'] ?? $container->load('get_ServiceLocator_XEjFHUzService'));

        if (isset($container->privates['.service_locator.xEjFHUz.App\\Controller\\DetalleCompraController::edit()'])) {
            return $container->privates['.service_locator.xEjFHUz.App\\Controller\\DetalleCompraController::edit()'];
        }

        return $container->privates['.service_locator.xEjFHUz.App\\Controller\\DetalleCompraController::edit()'] = $a->withContext('App\\Controller\\DetalleCompraController::edit()', $container);
    }
}
