<?php

namespace ContainerP5AZiK8;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_5qTdY6jService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.5qTdY6j' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.5qTdY6j'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'pedido' => ['privates', '.errored..service_locator.5qTdY6j.App\\Entity\\Pedidos', NULL, 'Cannot autowire service ".service_locator.5qTdY6j": it needs an instance of "App\\Entity\\Pedidos" but this type has been excluded in "config/services.yaml".'],
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
        ], [
            'pedido' => 'App\\Entity\\Pedidos',
            'entityManager' => '?',
        ]);
    }
}
