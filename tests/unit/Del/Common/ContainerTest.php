<?php

namespace Del\Common;

use Barnacle\Container;
use Codeception\TestCase\Test;
use DelTesting\TestPackage;
use ReflectionClass;

class ContainerTest extends Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var ContainerService
     */
    protected $containerSvc;

    protected function _before()
    {
        $this->containerSvc = ContainerService::getInstance();
    }

    protected function _after()
    {
        unset($this->containerSvc);
    }


    public function testCanGetContainer()
    {
        $this->assertInstanceOf(Container::class, $this->containerSvc->getContainer());
    }

    public function testCanGetAndSetCredentials()
    {

        $creds = $this->containerSvc->getDbCredentials();
        $creds->setUser('testuser');
        $this->containerSvc->setDbCredentials($creds);
        $creds = $this->containerSvc->getDbCredentials()->toArray();
        $this->assertTrue(is_array($creds));
        $this->assertEquals('testuser', $creds['user']);
    }


    public function testCanGetEntityManager()
    {
        $em = $this->containerSvc->getContainer()['doctrine.entity_manager'];
        $this->assertInstanceOf('Doctrine\ORM\EntityManager',$em);
    }


    public function testCanGetAndSetPaths()
    {
        $this->containerSvc->addEntityPath('vendor/random/src/Entity');
        $this->containerSvc->addEntityPath('vendor/delboy1978uk/src/Entity');
        $paths = $this->containerSvc->getEntityPaths();
        $this->assertContains('vendor/random/src/Entity',$paths);
        $this->assertContains('vendor/delboy1978uk/src/Entity',$paths);
    }


    public function testRegisterToContainer()
    {
        $config = new TestPackage();
        $this->containerSvc->registerToContainer($config);
        $paths = $this->containerSvc->getEntityPaths();
        $this->assertContains('vendor/random/src/Entity',$paths);
        $this->assertEquals('A boring old string.',$this->containerSvc->getContainer()['test.package']);
    }

    public function testSetProxyPaths()
    {
        $this->containerSvc->setProxyPath('/path/to/proxies');
        // Initialise container
        $this->containerSvc->getContainer();
        $reflection = new ReflectionClass('Del\Common\ContainerService');
        $property = $reflection->getProperty('proxyPath');
        $property->setAccessible(true);
        $proxyPath = $property->getValue($this->containerSvc);
        $this->assertTrue(is_string($proxyPath));
        $this->assertEquals('/path/to/proxies', $proxyPath);

    }

}
