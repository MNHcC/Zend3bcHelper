<?php

/**
 * Zend Framework (http://framework.zend.com/)
 */

namespace MNHcC\Zend3bcHelper\ServiceManager {

    use Zend\ServiceManager\ServiceManagerAwareInterface as ZendServiceManagerAwareInterface;

    interface ServiceManagerAwareInterface extends ZendServiceManagerAwareInterface {

        /**
         * Set service manager
         *
         * @param ServiceManager $serviceManager
         */
        public function setServiceManager(ServiceManager $serviceManager);
    }

}