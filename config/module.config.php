<?php

/**
 * MNHcC/Zend3bcHelper https://github.com/MNHcC/Zend3bcHelper
 *
 * @link      https://github.com/MNHcC/Zend3bcHelper for the canonical source repository
 * @author MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @copyright 2016, MNHcC  - Michael Hegenbarth (carschrotter) <mnh@mn-hegenbarth.de>
 * @license BSD
 */

namespace MNHcC\Zend3bcHelper {
    
    return [
        'view_helpers' => [
            'invokables' => [
                \Zend\I18n\View\Helper\Translate::class => \Zend\I18n\View\Helper\Translate::class
            ],
            'aliases' => [
                'translate' => \Zend\I18n\View\Helper\Translate::class,
                'translator' => \Zend\I18n\View\Helper\Translate::class,
            ],
        ],
    ];
}