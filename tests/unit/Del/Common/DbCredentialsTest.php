<?php

namespace Del\Common;

class DbCredentialsTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var DbCredentials
     */
    protected $creds;

    protected function _before()
    {
        $this->creds = DbCredentials::getInstance();
    }

    protected function _after()
    {
        unset($this->container);
    }


    public function testCanGetAndSetCredentials()
    {
        $this->creds->setCredentials([
            'driver' => 'pdo_mysql',
            'dbname' => 'testdb',
            'user' => 'testuser',
            'password' => '[123456]',
        ]);

        $creds = $this->creds->getCredentials();
        $this->assertTrue(is_array($creds));
        $this->assertEquals('testuser', $creds['user']);
    }
}
