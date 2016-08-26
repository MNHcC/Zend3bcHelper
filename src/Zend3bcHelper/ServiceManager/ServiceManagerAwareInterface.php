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