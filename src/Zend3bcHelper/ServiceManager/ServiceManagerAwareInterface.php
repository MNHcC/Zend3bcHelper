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

    use Zend\ServiceManager\ServiceManager;

    /**
     * Fork from Zend framework 2.5.* for the Zend3bcHelper
     */
    interface ServiceManagerAwareInterface extends Zend3bcHelperInterface {

        /**
         * Set service manager
         *
         * @param ServiceManager $serviceManager
         */
        public function setServiceManager(ServiceManager $serviceManager);
    }

}