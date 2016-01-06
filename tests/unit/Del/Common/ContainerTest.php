<?php

namespace Del\Common;

class ContainerTest extends \Codeception\TestCase\Test
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
        $this->assertInstanceOf('Pimple\Container',$this->containerSvc->getContainer());
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


}
