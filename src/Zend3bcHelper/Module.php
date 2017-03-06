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

    use Zend\Loader\ClassMapAutoloader;
    use Zend\Loader\StandardAutoloader;
    use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
    use Zend\ModuleManager\Feature\ServiceProviderInterface;
    use Zend\ModuleManager\Feature\ConfigProviderInterface;
    use Zend\ModuleManager\Feature\InitProviderInterface;
    use MNHcC\Zend3bcHelper\ServiceManager\DefaultServiceConfigProvider;

    const DS = \DIRECTORY_SEPARATOR;

    /**
     * Description of Module
     *
     * @author carschrotter
     */
    class Module implements AutoloaderProviderInterface, ServiceProviderInterface, ConfigProviderInterface, InitProviderInterface {

        const VERSION = '0.4.3-dev';

        /**
         * 
         * @return array the module config. Loaded from config file
         */
        public function getConfig() {
            $path = __DIR__ .  str_replace('/', DS, '/../../config/module.config.php');
            if(($tmp = realpath($path))) $path = $tmp;
            return require $path;
        }

        public function getAutoloaderConfig() {
            $config = [
                StandardAutoloader::class => [
                    'namespaces' => [
                        __NAMESPACE__ => __DIR__ . DS . 'src' . DS . str_replace('\\', DS, __NAMESPACE__)
                    ],
                ],
            ];
            //moore performance
            if (file_exists(__DIR__ . DS . 'autoload_classmap.php')) {
                $config[ClassMapAutoloader::class] = [__DIR__ . DS . 'autoload_classmap.php'];
            }
            return $config;
        }
        
        public function getServiceConfig() {
            return DefaultServiceConfigProvider::serviceConfig();
            
        }
        
        public function init(\Zend\ModuleManager\ModuleManagerInterface $manager) {
            /* @var $manager \Zend\ModuleManager\ModuleManager */
            //\Kint::dump( $manager->getEvent()->getConfigListener()->getMergedConfig() );
        }

    
    }

}
