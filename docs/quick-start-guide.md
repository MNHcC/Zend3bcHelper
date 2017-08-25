install this over composer
```
composer require "mnhcc/zend3bchelper"
```
and enable the module on your modules.config.php (>v3) or application.config.php
```php
[
///...
MNHcC\Zend3bcHelper::class,
///...
]
```
enable the magic in application.config.php over
```php
[
///...
    'service_manager' => MNHcC\Zend3bcHelper\ServiceManager\DefaultServiceConfigProvider::serviceConfig(),
///...
]
```
