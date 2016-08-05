<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Zend3bcHelper;

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

    const VERSION = '0.1.0dev';

    public function getAutoloaderConfig() {
        $config = [
            StandardAutoloader::class => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . DS . 'src' . DS . __NAMESPACE__
                ],
            ],
        ];
        //moore performance
        if (file_exists(__DIR__ . DS . 'autoload_classmap.php')) {
            $config[ClassMapAutoloader::class] = [$__DIR__ . DS . 'autoload_classmap.php'];
        }
        return $config;
    }

}
