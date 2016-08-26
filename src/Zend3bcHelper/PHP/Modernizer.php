<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MNHcC\Zend3bcHelper\PHP {

    /**
     * Description of Modernizer
     *
     * @author carschrotter
     */
    abstract class Modernizer {

        /**
         * (PHP 5 &gt;= 5.4, PHP 7)<br/>
         * Outputs or returns a parsable string representation of a variable in modern php >= <b>5.4</b> style.
         * Source from http://stackoverflow.com/questions/24316347/how-to-format-var-export-to-php5-4-array-syntax
         * @link http://php.net/manual/en/function.var-export.php
         * @param mixed $expression <p>
         * The variable you want to export.
         * </p>
         * @param bool $return [optional] <p>
         * If used and set to <b>TRUE</b>, <b>var_export</b> will return
         * the variable representation instead of outputting it.
         * </p>
         * @return string|null the variable representation when the <i>return</i>
         * parameter is used and evaluates to <b>TRUE</b>. Otherwise, this function will
         * return <b>NULL</b>.
         */
        public static function varExport($data, $return = true) {
            $dump = var_export($data, true);

            $dump = preg_replace('#(?:\A|\n)([ ]*)array \(#i', '[', $dump); // Starts
            $dump = preg_replace('#\n([ ]*)\),#', "\n$1],", $dump); // Ends
            $dump = preg_replace('#=> \[\n\s+\],\n#', "=> [],\n", $dump); // Empties

            if (gettype($data) == 'object') { // Deal with object states
                $dump = str_replace('__set_state(array(', '__set_state([', $dump);
                $dump = preg_replace('#\)\)$#', "])", $dump);
            } else {
                $dump = preg_replace('#\)$#', "]", $dump);
            }

            if ($return === true) {
                return $dump;
            } else {
                echo $dump;
            }
        }

        /**
         * (PHP 5 &gt;= 5.6, PHP 7)<br/>
         * Make a map of classes to here source file in modern may of syntax.
         * This is beautifull for the zend generators
         * @param array $data a map of classes to here source file
         * @return string the map in php 5.6 style
         */
        public static function modernizeZendPhpMap(array $data) {
            $data_new = static::varExport($data);
            return preg_replace("~'([a-z][a-z0-9_\\\]+[a-z])'~i", '\\\\\1::class', $data_new);
        }

    }

}