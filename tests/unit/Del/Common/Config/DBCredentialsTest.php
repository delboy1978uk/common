<?php

namespace Del\Common\Config;

use Del\Common\ContainerService;

class DBCredentialsTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var DBCredentials
     */
    protected $creds;

    protected function _before()
    {
        $this->creds = new DbCredentials();
        $this->creds->setDriver('pdo_mysql');
        $this->creds->setHost('mars');
        $this->creds->setDatabase('delboy1978uk');
        $this->creds->setUser('dbuser');
        $this->creds->setPassword('[123456]');
    }

    protected function _after()
    {
        unset($this->creds);
    }


    public function testCanGetDefaults()
    {
        $defaults = $this->creds->toArray();
        $this->assertContains('pdo_mysql',$defaults['driver']);
        $this->assertContains('delboy1978uk',$defaults['dbname']);
        $this->assertContains('dbuser',$defaults['user']);
        $this->assertContains('[123456]',$defaults['password']);
        $this->assertContains('mars',$defaults['host']);
    }

    public function testCanGetAndSetDriver()
    {
        $this->creds->setDriver('random driver');
        $this->assertEquals('random driver', $this->creds->getDriver());
    }

    public function testCanGetAndSetDBName()
    {
        $this->creds->setDatabase('DB!');
        $this->assertEquals('DB!', $this->creds->getDatabase());
    }

    public function testCanGetAndSetUser()
    {
        $this->creds->setUser('del');
        $this->assertEquals('del', $this->creds->getUser());
    }

    public function testCanGetAndSetPassword()
    {
        $this->creds->setPassword('123');
        $this->assertEquals('123', $this->creds->getPassword());
    }

    public function testCanGetAndSetHost()
    {
        $this->creds->setHost('mars');
        $this->assertEquals('mars', $this->creds->getHost());
    }

    public function testHasEntityPath()
    {
        $this->assertFalse($this->creds->hasEntityPath());
    }

    public function testGetEntityPath()
    {
        $this->assertEmpty($this->creds->getEntityPath());
    }

    public function testAddToContainer()
    {
        ContainerService::getInstance()->registerToContainer($this->creds);
        $creds = ContainerService::getInstance()->getContainer()['db.credentials'];
        $this->assertTrue(is_array($creds));
        $this->assertArrayHasKey('driver',$creds);
        $this->assertArrayHasKey('dbname',$creds);
        $this->assertArrayHasKey('user',$creds);
        $this->assertArrayHasKey('password',$creds);
    }



}
