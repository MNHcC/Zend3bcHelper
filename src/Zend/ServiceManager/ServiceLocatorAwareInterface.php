<?php

/**
 * Fork from Zend framework 2.5.*
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @copyright MNHcC (Michael Hegenbarth)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\ServiceManager;

use MNHcC\Zend3bcHelper;

if (interface_exists(Zend3bcHelper\ServiceManager\ServiceLocatorAwareInterface::class)) {
    class_alias(Zend3bcHelper\ServiceManager\ServiceLocatorAwareInterface::class, ServiceLocatorAwareInterface::class);
} else {

    /**
     * alias for the original zend framework 2.5 ServiceLocatorAwareInterface
     * {@inheritdoc}
     * @deprecated since zend framework 2.7|3.*
     */
    interface ServiceLocatorAwareInterface extends Zend3bcHelper\ServiceManager\ServiceLocatorAwareInterface {
        
    }

}
    
    

