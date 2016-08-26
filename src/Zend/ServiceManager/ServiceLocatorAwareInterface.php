<?php

/**
 * 
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\ServiceManager {

    use MNHcC\Zend3bcHelper\Basic\Zend3bcHelperInterface;
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