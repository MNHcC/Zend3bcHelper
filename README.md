### Status
[![Build Status](https://travis-ci.org/MNHcC/Zend3bcHelper.svg?branch=master)](https://travis-ci.org/MNHcC/Zend3bcHelper)
[![Coverage Status](https://coveralls.io/repos/github/MNHcC/Zend3bcHelper/badge.svg?branch=master)](https://coveralls.io/github/MNHcC/Zend3bcHelper?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/58bd3ff58be8c80041c62eae/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/58bd3ff58be8c80041c62eae)
# Zend3bcHelper
A Zend Framework 3 backwards compatibility helper modul. Get many behavior from ZF 2.5 on ZF 3

##installation
###composer on shell
```shell
~~composer config "repositories.mnhcc/zend3bchelper" vcs https://github.com/MNHcC/Zend3bcHelper.git~~
composer require "mnhcc/zend3bchelper"
```
###composer.json
```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/MNHcC/Zend3bcHelper.git"
        }
    ],
    "require": {
        "php": ">=5.6.0",
        "mnhcc/zend3bchelper": "dev-master"
    }
}
```

