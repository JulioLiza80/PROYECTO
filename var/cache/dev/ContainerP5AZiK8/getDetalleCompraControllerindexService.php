<?php

namespace ContainerP5AZiK8;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDetalleCompraControllerindexService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.lyo4z4O.App\Controller\DetalleCompraController::index()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.lyo4z4O.App\\Controller\\DetalleCompraController::index()'] = (new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'detalleCompraRepository' => ['privates', 'App\\Repository\\DetalleCompraRepository', 'getDetalleCompraRepositoryService', true],
        ], [
            'detalleCompraRepository' => 'App\\Repository\\DetalleCompraRepository',
        ]))->withContext('App\\Controller\\DetalleCompraController::index()', $container);
    }
}
