<?php

namespace Del\Common;

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



}
