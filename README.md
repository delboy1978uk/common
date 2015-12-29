# common
[![Build Status](https://travis-ci.org/delboy1978uk/common.png?branch=master)](https://travis-ci.org/delboy1978uk/common) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/common/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/common/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/common/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/common/?branch=master) <br />
Stuff that winds up in every project
##Db Credentials
Set the db credentials by passing an array
```
use Del\Common\DbCredentials;

DbCredentials::getInstance()->setCredentials([
    'driver' => 'pdo_mysql',
    'dbname' => 'delboy1978uk',
    'user' => 'dbuser',
    'password' => '[123456]',
]);
```
##Container
A Dependency Injection container. Contains a Doctrine 2 Entity Manager
```
$container = Container::getContainer();
$em = $container['doctrine.entity_manager']; // Requires DB connection params set before calling it
```