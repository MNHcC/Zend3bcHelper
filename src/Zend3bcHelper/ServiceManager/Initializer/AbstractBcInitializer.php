<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Zend3bcHelper\ServiceManager\Initializer;

use Interop\Container\ContainerInterface;

/**
 * 
 * AbstractBcInitializer is a proxy Initializer that auto invoke on old ServiceManager and use the new zf 3 method
 * @author Michael Hegenbarth <mnh@mn-hegenbarth.de>
 */
abstract class AbstractBcInitializer implements BcInitializerInterface {
    
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $instance) {
        return $this->initialize($instance, $container);
    }

    
}
