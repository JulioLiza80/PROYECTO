<?php

namespace ContainerSzs3fc0;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getPedidosControllershowService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.r1y8Dbo.App\Controller\PedidosController::show()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.r1y8Dbo.App\\Controller\\PedidosController::show()'] = (new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'pedido' => ['privates', '.errored..service_locator.r1y8Dbo.App\\Entity\\Pedidos', NULL, 'Cannot autowire service ".service_locator.r1y8Dbo": it needs an instance of "App\\Entity\\Pedidos" but this type has been excluded in "config/services.yaml".'],
        ], [
            'pedido' => 'App\\Entity\\Pedidos',
        ]))->withContext('App\\Controller\\PedidosController::show()', $container);
    }
}
