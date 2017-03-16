<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Zend3bcHelper\ServiceManager;

use MNHcC\Zend3bcHelper\Basic;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager;

/**
 * 
 * BcFactoryInterface extends FactoryInterface interface whit new methods of ZF 3
 * @author Michael Hegenbarth <mnh@mn-hegenbarth.de>
 */
interface BcFactoryInterface extends ServiceManager\FactoryInterface, Basic\Zend3bcHelperInterface {
    
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return object
     * @throws ServiceManager\Exception\ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceManager\Exception\ServiceNotCreatedException if an exception is raised when creating a service.
     * @throws \Interop\Container\Exception\ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null);
}
