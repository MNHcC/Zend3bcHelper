<?php

/**
 * Fork from Zend framework 2.5.*
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\ServiceManager {

    use MNHcC\Zend3bcHelper\ServiceManager\ServiceLocatorAwareTrait as MNHcCServiceLocatorAwareTrait;

    /**
     * Fork from zend framework 2.5.* for the Zend3bcHelper
     * @deprecated since zend framework 2.7|3.*
     */
    trait ServiceLocatorAwareTrait {

        use MNHcCServiceLocatorAwareTrait {
            getServiceLocator as MNHcCServiceLocatorAwareTrait_getServiceLocator;
        }

        /**
         * Get service locator
         * Add a user error for see is deprecated
         * 
         * @return ServiceLocatorInterface
         */
        public function getServiceLocator() {
            \trigger_error(sprintf(
                            'You are retrieving the service locator from within the class %s. Please be aware that '
                            . 'ServiceLocatorAwareInterface is deprecated and is removed in version 3.0, along '
                            . 'with the ServiceLocatorAwareInitializer. You will need to update your class to accept '
                            . 'all dependencies at creation, either via constructor arguments or setters, and use '
                            . 'a factory to perform the injections. Or you replace simple %s whit %s to remove this message', static::class, ServiceLocatorAwareTrait::class, MNHcCServiceLocatorAwareTrait::class
                    ), \E_USER_DEPRECATED);
            return $this->MNHcCServiceLocatorAwareTrait_getServiceLocator();
        }

    }

}
