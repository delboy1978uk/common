# common
[![Build Status](https://travis-ci.org/delboy1978uk/common.png?branch=master)](https://travis-ci.org/delboy1978uk/common) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/common/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/common/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/common/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/common/?branch=master) <br />
Stuff that winds up in every project. 
## Db Credentials
Set the db credentials by passing an array
```php
use Del\Common\Config\DbCredentials;

$credentials = new DbCredentials([
    'driver' => 'pdo_mysql',
    'dbname' => 'delboy1978uk',
    'user' => 'dbuser',
    'password' => '[123456]',
]);
```
## DIC Container Factory Service
```php
use Del\Common\ContainerService;

$containerSvc = ContainerService::getInstance();
```
## Service Methods
```php
$containerSvc->setDbCredentials($credentials); // Do this before getContainer() to configure the DBAL Connection
$containerSvc->addEntityPath('path/to/entities'); // You can add multiple paths to get Entities from different packages
$containerSvc->registerToContainer($registrationInterface); // See below
```
## Container Registration Interface
You can create a class in your own packages that will register any definitions that go in the container. Just implement
Barnacle\RegistrationInterface. E.g.
```php
namespace My\Config\Container;


use Barnacle\Container;
use Barnacle\RegistrationInterface;
use Doctrine\ORM\EntityManager;
use My\Repository\Dog as DogRepository;

class DogPackage implements RegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $c['repository.dog'] = $c->factory(function ($c) {
            /** @var EntityManager $em */
            $em = $c['doctrine.entity_manager'];
            /** @var DogRepository $repo */
            $repo = $em->getRepository('My\Entity\Dog');
            return $repo; 
        });
    }
}
```
## Pimple Container
A Dependency Injection container. Which now contains a configured Doctrine 2 Entity Manager
```
$container = $containerSvc->getContainer();
$em = $container['doctrine.entity_manager'];
$dogRepo = $container['repository.dog'];
```
## Value Objects
There have several value objects which extend Del\Common\Value\AbstractValue.
```php
use Del\Common\Value\DecimalValue;
use Del\Common\Value\IntValue;
use Del\Common\Value\StringValue;

$money = new DecimalValue(123.45);
$text = new StringValue('Hooray');
$int = new IntValue(500);

echo $money->getValue();
echo $text->getValue();
echo $int->getValue();
```
