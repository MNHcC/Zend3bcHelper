<?php
/**
 * MNHcC/Zend3bcHelper https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/Zend3bcHelper for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\Zend3bcHelper {

    use Interop\Container\ContainerInterface;
    use Zend\ServiceManager\AbstractPluginManager;
    use Zend\ServiceManager\ServiceLocatorAwareInterface;
    use Zend\ServiceManager\ServiceManager;
    use Zend\ServiceManager\ServiceManagerAwareInterface;
    use MNHcC\Zend3bcHelper\ServiceManager\ServiceLocatorAwareInterface as MNHcCServiceLocatorAwareInterface;
    use MNHcC\Zend3bcHelper\ServiceManager\ServiceManagerAwareInterface as MNHcCServiceManagerAwareInterface;

return [
        /**
         * fork from Zend framework 2.5.*
         * Zend Framework (http://framework.zend.com/)
         *
         * @link      http://github.com/zendframework/zf2 for the canonical source repository
         * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
         * @license   http://framework.zend.com/license/new-bsd New BSD License
         */
        'service_manager' => [ // override the default ServiceLocatorAwareInitializer and ServiceManagerAwareInitializer
            'ServiceManagerAwareInitializer' => function ($first, $second) {
                if ($first instanceof ContainerInterface) {
                    // zend-servicemanager v3
                    $container = $first;
                    $instance = $second;
                } else {
                    // zend-servicemanager v2
                    $container = $second;
                    $instance = $first;
                }

                //trigger error only on original ServiceManagerAwareInterface not on reimplented
                if ($container instanceof ServiceManager && $instance instanceof ServiceManagerAwareInterface) {
                    if (!$container instanceof MNHcCServiceManagerAwareInterface) {
                        trigger_error(sprintf(
                                        'ServiceManagerAwareInterface is deprecated and will be removed in version 3.0, along '
                                        . 'with the ServiceManagerAwareInitializer. Please update your class %s to remove '
                                        . 'the implementation, and start injecting your dependencies via factory instead.', get_class($instance)
                                ), \E_USER_DEPRECATED);
                    }

                    $instance->setServiceManager($container);
                }
            },
            'ServiceLocatorAwareInitializer' => function ($first, $second) {
                if ($first instanceof AbstractPluginManager) {
                    // Edge case under zend-servicemanager v2
                    $container = $second;
                    $instance = $first;
                } elseif ($first instanceof ContainerInterface) {
                    // zend-servicemanager v3
                    $container = $first;
                    $instance = $second;
                } else {
                    // zend-servicemanager v2
                    $container = $second;
                    $instance = $first;
                }
                // For service locator aware classes, inject the service
                // locator, but emit a deprecation notice when is not MNHcCServiceLocatorAwareInterface. Skip plugin manager
                // implementations; they're dealt with later.
                if (!$instance instanceof MNHcCServiceLocatorAwareInterface && $instance instanceof ServiceLocatorAwareInterface && !$instance instanceof AbstractPluginManager
                ) {
                    trigger_error(sprintf(
                                    'ServiceLocatorAwareInterface is deprecated and will be removed in version 3.0, along '
                                    . 'with the ServiceLocatorAwareInitializer. Please update your class %s to remove '
                                    . 'the implementation, and start injecting your dependencies via factory instead.', get_class($instance)
                            ), \E_USER_DEPRECATED);
                }

                // For service locator aware plugin managers that do not have
                // the service locator already injected, inject it, but emit a
                // deprecation notice when is not MNHcCServiceLocatorAwareInterface
                if (!$instance instanceof MNHcCServiceLocatorAwareInterface && $instance instanceof ServiceLocatorAwareInterface && $instance instanceof AbstractPluginManager && !$instance->getServiceLocator()
                ) {
                    trigger_error(sprintf(
                                    'ServiceLocatorAwareInterface is deprecated and will be removed in version 3.0, along '
                                    . 'with the ServiceLocatorAwareInitializer. Please update your %s plugin manager factory '
                                    . 'to inject the parent service locator via the constructor.', get_class($instance)
                            ), \E_USER_DEPRECATED);
                }

                if ($instance instanceof ServiceLocatorAwareInterface) {
                    $instance->setServiceLocator($container);
                }
            },
        ]
    ];
}