#!/usr/bin/env php
<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @category   Zend
 * @package    Zend_Loader
 * @subpackage Exception
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
use Zend\Console;
use MNHcC\Zend3bcHelper\PHP\Modernizer;

/**
 * Generate class maps for use with autoloading.
 *
 * Usage:
 * --help|-h                    Get usage message
 * --library|-l [ <string> ]    Library to parse; if none provided, assumes
 *                              current directory
 * --output|-o [ <string> ]     Where to write autoload file; if not provided,
 *                              assumes "autoload_classmap.php" in library directory
 * --append|-a                  Append to autoload file if it exists
 * --overwrite|-w               Whether or not to overwrite existing autoload
 *                              file
 */
// Setup/verify autoloading
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    // Local install
    require __DIR__ . '/../vendor/autoload.php';
} elseif (file_exists(getcwd() . '/vendor/autoload.php')) {
    // Root project is current working directory
    require getcwd() . '/vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/../../../autoload.php')) {
    // Relative to composer install
    require __DIR__ . '/../../../autoload.php';
} else {
    fwrite(STDERR, "Unable to setup autoloading; aborting\n");
    exit(2);
}

$libPath = getenv('LIB_PATH') ? getenv('LIB_PATH') : __DIR__ . '/../library';
if (!is_dir($libPath)) {
    // Try to load StandardAutoloader from include_path
    if (false === (include 'Zend/Loader/StandardAutoloader.php')) {
        echo "Unable to locate autoloader via include_path; aborting" . PHP_EOL;
        exit(2);
    }
} else {
    // Try to load StandardAutoloader from library
    if (false === (include $libPath . '/Zend/Loader/StandardAutoloader.php')) {
        echo "Unable to locate autoloader via library; aborting" . PHP_EOL;
        exit(2);
    }
}

$rules = array(
    'help|h' => 'Get usage message',
    'library|l-s' => 'Library to parse; if none provided, assumes current directory',
    'output|o-s' => 'Where to write plugin map file; if not provided, assumes "plugin_classmap.php" in library directory',
    'append|a' => 'Append to plugin map file if it exists',
    'overwrite|w' => 'Whether or not to overwrite existing autoload file',
);

try {
    $opts = new Console\Getopt($rules);
    $opts->parse();
} catch (Console\Exception\RuntimeException $e) {
    echo $e->getUsageMessage();
    exit(2);
}

if ($opts->getOption('h')) {
    echo $opts->getUsageMessage();
    exit();
}

$path = $libPath;
if (array_key_exists('PWD', $_SERVER)) {
    $path = $_SERVER['PWD'];
}

if (isset($opts->l)) {
    $libraryPath = $opts->l;
    $libraryPath = rtrim($libraryPath, '/\\') . DIRECTORY_SEPARATOR;
    if (!is_dir($libraryPath)) {
        echo "Invalid library directory provided" . PHP_EOL . PHP_EOL;
        echo $opts->getUsageMessage();
        exit(2);
    }
    $path = realpath($libraryPath);
}

$usingStdout = false;
$appending = $opts->getOption('a');
$output = $path . DIRECTORY_SEPARATOR . 'plugin_classmap.php';
if (isset($opts->o)) {
    $output = $opts->o;
    if ('-' == $output) {
        $output = STDOUT;
        $usingStdout = true;
    } elseif (!is_writeable(dirname($output))) {
        echo "Cannot write to '$output'; aborting." . PHP_EOL
        . PHP_EOL
        . $opts->getUsageMessage();
        exit(2);
    } elseif (file_exists($output)) {
        if (!$opts->getOption('w') && !$appending) {
            echo "Plugin map file already exists at '$output'," . PHP_EOL
            . "but 'overwrite' flag was not specified; aborting." . PHP_EOL
            . PHP_EOL
            . $opts->getUsageMessage();
            exit(2);
        }
    }
}

if (!$usingStdout) {
    if ($appending) {
        echo "Appending to plugin class map '$output' for classes in '$path'..." . PHP_EOL;
    } else {
        echo "Creating plugin class map for classes in '$path'..." . PHP_EOL;
    }
}

// Get the ClassFileLocator, and pass it the library path
$l = new \Zend\File\ClassFileLocator($path);

// Iterate over each element in the path, and create a map of pluginname => classname
$map = new \stdClass;
foreach ($l as $file) {
    $namespaces = $file->getNamespaces();
    $namespace = empty($file->namespace) ? '' : $file->namespace . '\\';

    foreach ($file->getClasses() as $classname) {
        $plugin = $classname;
        foreach ($namespaces as $namespace) {
            $namespace .= '\\';
            if (0 === strpos($plugin, $namespace)) {
                $plugin = str_replace($namespace, '', $plugin);
            }
        }
        $plugin = strtolower($plugin);
        $map->{$plugin} = $classname;
    }
}

if ($appending) {
    $content = Modernizer::modernizeZendPhpMap((array) $map, true) . ';';

    // Fix \' strings from injected DIRECTORY_SEPARATOR usage in iterator_apply op
    $content = str_replace("\\'", "'", $content);

    // Convert to an array and remove the first "array ("
    $content = explode("\n", $content);
    array_shift($content);

    // Load existing class map file and remove the closing "bracket ");" from it
    $existing = file($output, FILE_IGNORE_NEW_LINES);
    array_pop($existing);

    // Merge
    $content = implode("\n", $existing + $content);
} else {
    // Create a file with the class/file map.
    // Stupid syntax highlighters make separating < from PHP declaration necessary
    $content = '<' . "?php" . PHP_EOL . PHP_EOL
            . '// plugin class map' . PHP_EOL
            . '// Generated by MNHcC\\Zend3bcHelper\'s '
            . basename($_SERVER['argv'][0]) 
            . ' (forked from Zend Framework 2) on ' 
            . date('Y-m-d H:i:s'). PHP_EOL . PHP_EOL
            . 'return ' . Modernizer::modernizeZendPhpMap((array) $map, true) . ';';

    // Fix \' strings from injected DIRECTORY_SEPARATOR usage in iterator_apply op
    $content = str_replace("\\'", "'", $content);
}

// Make the file end by EOL
$content = rtrim($content, PHP_EOL) . PHP_EOL;

// Write the contents to disk
file_put_contents($output, $content);

if (!$usingStdout) {
    echo "Wrote plugin classmap file to '" . realpath($output) . "'" . PHP_EOL;
}
