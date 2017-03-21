<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Zend3bcHelper\ServiceManager\Initializer;

use MNHcC\Zend3bcHelper\Basic;
use Zend\ServiceManager;
use Interop\Container\ContainerInterface;

/**
 * 
 * BcInitializerInterface extends InitializerInterface interface whit new methods of ZF 3
 * @author Michael Hegenbarth <mnh@mn-hegenbarth.de>
 */
interface BcInitializerInterface extends ServiceManager\InitializerInterface, Basic\Zend3bcHelperInterface {
    
    /**
     * Initialize the given instance
     *
     * @param  ContainerInterface $container
     * @param  object             $instance
     * @return void
     */
    public function __invoke(ContainerInterface $container, $instance);
}
