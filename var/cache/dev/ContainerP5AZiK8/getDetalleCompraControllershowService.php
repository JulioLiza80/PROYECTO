<?php

namespace ContainerP5AZiK8;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDetalleCompraControllershowService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.Wr4XQa_.App\Controller\DetalleCompraController::show()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Wr4XQa_.App\\Controller\\DetalleCompraController::show()'] = (new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'detalleCompra' => ['privates', '.errored..service_locator.Wr4XQa_.App\\Entity\\DetalleCompra', NULL, 'Cannot autowire service ".service_locator.Wr4XQa_": it needs an instance of "App\\Entity\\DetalleCompra" but this type has been excluded in "config/services.yaml".'],
        ], [
            'detalleCompra' => 'App\\Entity\\DetalleCompra',
        ]))->withContext('App\\Controller\\DetalleCompraController::show()', $container);
    }
}
