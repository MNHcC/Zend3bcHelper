<?php

/**
 * MNHcC/Zend3bcHelper https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/Zend3bcHelper for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\Zend3bcHelper\ServiceManager {

    use Zend\ServiceManager\ServiceLocatorInterface;

    /**
     * fork from Zend framework 2.5.*
     */
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
