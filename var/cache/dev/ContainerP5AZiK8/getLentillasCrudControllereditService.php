<?php

namespace ContainerP5AZiK8;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getLentillasCrudControllereditService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.HOzo2Xr.App\Controller\Admin\LentillasCrudController::edit()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.HOzo2Xr.App\\Controller\\Admin\\LentillasCrudController::edit()'] = ($container->privates['.service_locator.HOzo2Xr'] ?? $container->load('get_ServiceLocator_HOzo2XrService'))->withContext('App\\Controller\\Admin\\LentillasCrudController::edit()', $container);
    }
}
