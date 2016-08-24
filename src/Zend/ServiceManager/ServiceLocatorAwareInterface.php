<?php

/**
 * fork from Zend framework 2.5.*
 * Zend Framework (http://framework.zend.com/)
 */

namespace Zend\ServiceManager {

    use MNHcC\Zend3bcHelper\Basic\Zend3bcHelperInterface;

    interface ServiceLocatorAwareInterface extends Zend3bcHelperInterface {

        /**
         * Set service locator
         *
         * @param ServiceLocatorInterface $serviceLocator
         */
        public function setServiceLocator(ServiceLocatorInterface $serviceLocator);

        /**
         * Get service locator
         *
         * @return ServiceLocatorInterface
         */
        public function getServiceLocator();
    }
}