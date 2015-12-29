<?php

namespace Del\Common;

class ContainerTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Container
     */
    protected $containerSvc;

    protected function _before()
    {
        $this->containerSvc = Container::getInstance();
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
        $this->containerSvc->setDbCredentials([
            'driver' => 'pdo_mysql',
            'dbname' => 'testdb',
            'user' => 'testuser',
            'password' => '[123456]',
        ]);

        $creds = $this->containerSvc->getDbCredentials();
        $this->assertTrue(is_array($creds));
        $this->assertEquals('testuser', $creds['user']);
    }


    public function testCanGetEntityManager()
    {
        $em = $this->containerSvc->getContainer()['doctrine.entity_manager'];
        $this->assertInstanceOf('Doctrine\ORM\EntityManager',$em);
    }

}
