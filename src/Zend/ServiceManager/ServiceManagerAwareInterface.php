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