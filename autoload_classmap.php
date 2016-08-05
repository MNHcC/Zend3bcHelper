<?php

namespace {

    use \Zend\ServiceManager\ServiceLocatorAwareInterface,
        \Zend\ServiceManager\ServiceLocatorAwareTrait;

// classmap for removed zend interface and trait
    return [
        ServiceLocatorAwareInterface::class => __DIR__ . '/src/Zend/ServiceManager/ServiceLocatorAwareInterface.php',
        ServiceLocatorAwareTrait::class => __DIR__ . '/src/Zend/ServiceManager/ServiceLocatorAwareTrait.php',
    ];
}