<?php

namespace ContainerSzs3fc0;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getLentillasCrudControllerconfigureActionsService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.LHPXyzR.App\Controller\Admin\LentillasCrudController::configureActions()' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.LHPXyzR.App\\Controller\\Admin\\LentillasCrudController::configureActions()'] = ($container->privates['.service_locator.LHPXyzR'] ?? $container->load('get_ServiceLocator_LHPXyzRService'))->withContext('App\\Controller\\Admin\\LentillasCrudController::configureActions()', $container);
    }
}
