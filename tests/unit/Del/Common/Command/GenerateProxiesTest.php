<?php

namespace Del\Common\Command;

use Del\Common\Command\GenerateProxy;
use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Tester\CommandTester;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand;
use Symfony\Component\Console\Helper\DialogHelper;

class GenerateProxyTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Application
     */
    protected $app;

    protected function _before()
    {
        $credentials = new DbCredentials();
        $credentials->setDriver('pdo_mysql')
            ->setDatabase('delboy1978uk')
            ->setUser('dbuser')
            ->setPassword('[123456]');
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
        $this->setExpectedException('Exception');
        $command = $this->app->find('generate-proxies');
        $test = new CommandTester($command);
        $test->execute(array('command' => $command->getName()));
    }
}
