# Doctrine 2 ORM Module for Zend Expressive

[![Build Status](https://travis-ci.org/vasildakov/expressive-doctrine.svg?branch=master)](https://travis-ci.org/vasildakov/expressive-doctrine)
[![Coverage Status](https://coveralls.io/repos/github/vasildakov/expressive-doctrine/badge.svg?branch=master)](https://coveralls.io/github/vasildakov/expressive-doctrine?branch=master)
[![Latest Stable Version](https://poser.pugx.org/vasildakov/expressive-doctrine/v/stable)](https://packagist.org/packages/vasildakov/expressive-doctrine)
[![Latest Unstable Version](https://poser.pugx.org/vasildakov/expressive-doctrine/v/unstable)](https://packagist.org/packages/vasildakov/expressive-doctrine)
[![License](https://poser.pugx.org/vasildakov/expressive-doctrine/license)](https://packagist.org/packages/vasildakov/expressive-doctrine)
[![Dependency Status](https://www.versioneye.com/user/projects/57235c11ba37ce0031fc18c8/badge.svg?style=flat)](https://www.versioneye.com/user/projects/57235c11ba37ce0031fc18c8)

## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```sh
composer require vasildakov/expressive-doctrine
```

## Entities settings

## Connection settings
```php
<?php
return [
    'doctrine' => [
        'connection' => [
            // default connection
            'orm_default' => [
                'driverClass' => Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'driver'   => 'pdo_mysql',
                    'host'     => '127.0.0.1',
                    'port'     => '3306',
                    'dbname'   => 'database',
                    'user'     => 'username',
                    'password' => 'password',
                    'charset'  => 'UTF8',
                ],
            ],
        ],
    ],
];
```