<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Zend3bcHelper {

    use Zend\Loader\ClassMapAutoloader;
    use Zend\Loader\StandardAutoloader;
    use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

    const DS = \DIRECTORY_SEPARATOR;

    /**
     * Description of Module
     *
     * @author carschrotter
     */
    class Module implements AutoloaderProviderInterface {

        const VERSION = '0.1.0-dev';

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

    }

}