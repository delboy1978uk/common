<?php

namespace Del\Common\Command;

use Codeception\TestCase\Test;
use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Tester\CommandTester;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;

class GenerateProxyTest extends Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    protected function _before()
    {
        $credentials = new DbCredentials();
        $credentials->setDriver('pdo_mysql');
        $credentials->setDatabase('delboy1978uk');
        $credentials->setUser('dbuser');
        $credentials->setPassword('[123456]');
        $container = ContainerService::getInstance()
            ->setDbCredentials($credentials)
            ->addEntityPath('src/Entity')
            ->getContainer();

        $em = $container['doctrine.entity_manager'];

        $helperSet = ConsoleRunner::createHelperSet($em);
        $helperSet->set(new QuestionHelper(), 'dialog');

        $this->app = new Application();
        $gen = new GenerateProxy();
        $gen->setHelperSet($helperSet);
        $this->app->add($gen);
        $this->app->add(new VersionCommand());
    }

    protected function _after()
    {
        unset($this->app);
    }


    public function testGenerateProxies()
    {
        $this->expectException('Exception');
        $command = $this->app->find('generate-proxies');
        $test = new CommandTester($command);
        $test->execute(array('command' => $command->getName()));
    }
}
