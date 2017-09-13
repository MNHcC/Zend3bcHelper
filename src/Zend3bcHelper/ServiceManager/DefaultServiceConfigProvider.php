<?php

/**
 * MNHcC/Zend3bcHelper https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/Zend3bcHelper for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\Zend3bcHelper\ServiceManager {

    use Zend\ModuleManager\Feature\ServiceProviderInterface;
    use Zend\Stdlib\ArrayUtils;
    use Interop\Container\ContainerInterface;
    use Zend\ServiceManager\AbstractPluginManager;
    use Zend\ServiceManager\ServiceManager;
    use Zend\ServiceManager\ServiceLocatorAwareInterface as ZendServiceLocatorAwareInterface;
    use Zend\ServiceManager\ServiceManagerAwareInterface as ZendServiceManagerAwareInterface;
    use MNHcC\Zend3bcHelper\Helper\AbstractTypeHelper;
    use MNHcC\Zend3bcHelper\ServiceManager\ServiceLocatorAwareInterface as MNHcCServiceLocatorAwareInterface;
    use MNHcC\Zend3bcHelper\ServiceManager\ServiceManagerAwareInterface as MNHcCServiceManagerAwareInterface;

    /**
     * Description of DefaultConfigProvider
     *
     * @author carschrotter
     */
    class DefaultServiceConfigProvider implements ServiceProviderInterface {

        public function __invoke() {
            return self::getServiceConfig();
        }
        /**
         * 
         * @param array $config
         * @return array
         */
        public static function serviceConfig($config = []) {
            
            $config = is_array($config) ? $config : ArrayUtils::iteratorToArray($config, true);
            
            return ArrayUtils::merge(
                [
                    'initializers' =>
                        [// override the default ServiceLocatorAwareInitializer and ServiceManagerAwareInitializer
                            /**
                             * fork from Zend framework 2.5.*
                             * Zend Framework (http://framework.zend.com/)
                             *
                             * @link      http://github.com/zendframework/zf2 for the canonical source repository
                             * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
                             * @license   http://framework.zend.com/license/new-bsd New BSD License
                             */
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
                                
                                if ($container instanceof ServiceManager && ($instance instanceof ZendServiceManagerAwareInterface || $instance instanceof ServiceManagerAwareInterface)) { //instanceof trigger no autoload for alias
//                                    
//                                    if (!AbstractTypeHelper::isZend3bcHelperClass($instance)) { //trigger error only on original ZendServiceManagerAwareInterface not on reimplemented
//                                        trigger_error(sprintf(
//                                                        'ServiceManagerAwareInterface is deprecated and will be removed in version 3.0 of Zend Framework, along '
//                                                        . 'with the ServiceManagerAwareInitializer. Please update your class %s to to use %s or remove '
//                                                        . 'the implementation, and start injecting your dependencies via factory instead.', get_class($instance), MNHcCServiceManagerAwareInterface::class
//                                                ), \E_USER_DEPRECATED);
//                                    }

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
//                                // For service locator aware classes, inject the service
//                                // locator, but emit a deprecation notice when is not MNHcCServiceLocatorAwareInterface. Skip plugin manager
//                                // implementations; they're dealt with later.
//                                if ($instance instanceof ZendServiceLocatorAwareInterface && !AbstractTypeHelper::isZend3bcHelperClass($instance) && !($instance instanceof AbstractPluginManager)
//                                ) {
//                                    trigger_error(sprintf(
//                                                    'ServiceLocatorAwareInterface is deprecated and will be removed in version 3.0 of Zend Framework, along '
//                                                    . 'with the ServiceLocatorAwareInitializer. Please update your class %s to use %s or remove '
//                                                    . 'the implementation, and start injecting your dependencies via factory instead.', get_class($instance), MNHcCServiceLocatorAwareInterface::class
//                                            ), \E_USER_DEPRECATED);
//                                }
//
//                                // For service locator aware plugin managers that do not have
//                                // the service locator already injected, inject it, but emit a
//                                // deprecation notice when is not MNHcCServiceLocatorAwareInterface
//                                if ($instance instanceof ZendServiceLocatorAwareInterface && !AbstractTypeHelper::isZend3bcHelperClass($instance) && $instance instanceof AbstractPluginManager && !$instance->getServiceLocator()
//                                ) {
//                                    trigger_error(sprintf(
//                                                    'ServiceLocatorAwareInterface is deprecated and will be removed in version 3.0 of Zend Framework, along '
//                                                    . 'with the ServiceLocatorAwareInitializer. Please update your %s plugin manager factory to use %s '
//                                                    . 'or to inject the parent service locator via the constructor.', get_class($instance), MNHcCServiceLocatorAwareInterface::class
//                                            ), \E_USER_DEPRECATED);
//                                }

                                if ($instance instanceof ZendServiceLocatorAwareInterface ||  $instance instanceof MNHcCServiceLocatorAwareInterface) { //instanceof trigger no autoload for alias
                                    $instance->setServiceLocator($container);
                                }
                            }
                        ]
                ], 
                $config
            );
        }

        /**
         * 
         * @param array $config
         * @return array
         */
        public function getServiceConfig() {
            $config = func_get_arg(0) ?: [];
            return static::serviceConfig($config);
        }

    }

}