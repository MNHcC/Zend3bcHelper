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

    use MNHcC\Zend3bcHelper\Basic\Zend3bcHelperInterface;
    use Zend\ServiceManager\ServiceLocatorInterface;
    /**
     * Fork from Zend framework 2.5.* for the Zend3bcHelper
     */
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