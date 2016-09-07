<?php

/**
 * MNHcC/Zend3bcHelper https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/Zend3bcHelper for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\Zend3bcHelper\Helper {

    use MNHcC\Zend3bcHelper\Basic\Zend3bcHelperInterface;

    /**
     * Description of AbstractTypeHelper
     *
     * @author carschrotter
     */
    abstract class AbstractTypeHelper implements Zend3bcHelperInterface {

        /**
         * Check is a Removed Zend Class or Moved Namespace, reimplemented from Zend3bcHelper
         * Check whit instanceof Zend3bcHelperInterface or defined('SomeClass::IS_ZEND_3_BC_HELPER_CLASS')
         * @param string $class_or_object the class or object you would test
         * @return bool true is a reimplemented class
         * @throws \ReflectionException
         */
        public static function isZend3bcHelperClass($class_or_object) {
            $refl = new \ReflectionClass($class_or_object);
            return (bool) $refl->isSubclassOf(Zend3bcHelperInterface::class) || $refl->hasConstant(static::IS_ZEND_3_BC_HELPER_CLASS);
        }

    }

}