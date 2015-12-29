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
    protected $container;

    protected function _before()
    {
        $this->container = Container::getContainer();
    }

    protected function _after()
    {
        unset($this->container);
    }


    public function testCanGetContainer()
    {
        $this->assertInstanceOf('Pimple\Container',$this->container);
    }


    public function testCanGetEntityManager()
    {
        $em = $this->container['doctrine.entity_manager'];
        $this->assertInstanceOf('Doctrine\ORM\EntityManager',$em);
    }


}
