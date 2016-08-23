<?php

/**
 * fork from Zend framework 2.5.*
 */

namespace MNHcC\Zend3bcHelper\ServiceManager {

    trait ServiceLocatorAwareTrait {

        /**
         * @var ServiceLocatorInterface
         */
        protected $serviceLocator = null;

        /**
         * Set service locator
         *
         * @param ServiceLocatorInterface $serviceLocator
         * @return $this
         */
        public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
            $this->serviceLocator = $serviceLocator;
            return $this;
        }

        /**
         * Get service locator
         * 
         * @return ServiceLocatorInterface
         */
        public function getServiceLocator() {
            return $this->serviceLocator;
        }

    }
}
