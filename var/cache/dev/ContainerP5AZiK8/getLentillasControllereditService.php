<?php

namespace ContainerP5AZiK8;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getLentillasControllereditService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.ma8QXqC.App\Controller\LentillasController::edit()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        $a = ($container->privates['.service_locator.ma8QXqC'] ?? $container->load('get_ServiceLocator_Ma8QXqCService'));

        if (isset($container->privates['.service_locator.ma8QXqC.App\\Controller\\LentillasController::edit()'])) {
            return $container->privates['.service_locator.ma8QXqC.App\\Controller\\LentillasController::edit()'];
        }

        return $container->privates['.service_locator.ma8QXqC.App\\Controller\\LentillasController::edit()'] = $a->withContext('App\\Controller\\LentillasController::edit()', $container);
    }
}
