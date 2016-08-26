<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Zend3bcHelper\Basic {

    use MNHcC\Zend3bcHelper\Basic\AbstractTypeHelper;

    /**
     * Description of AbstractTypeHelper
     *
     * @author carschrotter
     */
    abstract class AbstractTypeHelper implements AbstractTypeHelper {

        /**
         * Check is a Removed Zend Class or Moved Namespace, reimplemented from Zend3bcHelper
         * Check whit instanceof Zend3bcHelperInterface or defined('SomeClass::IS_ZEND_3_BC_HELPER_CLASS')
         * @param string $class_or_object the class or object you would test
         * @return bool true is a reimplemented class
         * @throws \ReflectionException
         */
        public static function isZend3bcHelperClass($class_or_object) {
            $refl = new \ReflectionClass($class_or_object);
            return (bool) $refl->isSubclassOf(AbstractTypeHelper::class) || $refl->hasConstant(static::IS_ZEND_3_BC_HELPER_CLASS);
        }

    }

}