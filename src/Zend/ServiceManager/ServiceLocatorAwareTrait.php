<?php

/**
 * fork from Zend framework 2.5.*
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\ServiceManager {

    trait ServiceLocatorAwareTrait {

        /**
         * @var ServiceLocatorInterface
         */
        protected $serviceLocator = null;

        /**
         * Set service locator
         *
         * @param ServiceLocatorInterface $serviceLocator
         * @return mixed
         */
        public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
            $this->serviceLocator = $serviceLocator;

            return $this;
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
                            . 'ServiceLocatorAwareInterface is deprecated and will be removed in version 3.0, along '
                            . 'with the ServiceLocatorAwareInitializer. You will need to update your class to accept '
                            . 'all dependencies at creation, either via constructor arguments or setters, and use '
                            . 'a factory to perform the injections.', static::class
                    ), \E_USER_DEPRECATED);
            return $this->serviceLocator;
        }

    }
}
