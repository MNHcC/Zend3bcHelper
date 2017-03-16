<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Zend3bcHelper\ServiceManager;

/**
 * 
 * AbstractBcFactory is a proxy Factory that auto invoke on old ServiceManager and use the new zf 3 method
 * @author Michael Hegenbarth <mnh@mn-hegenbarth.de>
 */
abstract class AbstractBcFactory implements BcFactoryInterface {

    public function createService(ServiceLocatorInterface $services) {
        return $this($services, \preg_replace('~Factory$~', '', __CLASS__));
    }
    
}
