<?php

namespace Del\Common\Command;

use Del\Common\Command\Migration;
use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;
use Doctrine\Migrations\Configuration\Configuration;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Tester\CommandTester;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Symfony\Component\Console\Helper\DialogHelper;

class MigrationTest extends \Codeception\TestCase\Test
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
        $credentials->setDriver('pdo_mysql');
        $credentials->setDatabase('awesome');
        $credentials->setUser('root');
        $credentials->setHost('127.0.0.1');
        $credentials->setPassword('');
        $container = ContainerService::getInstance()
                ->setDbCredentials($credentials)
                ->addEntityPath('src/Entity')
                ->getContainer();

        $em = $container['doctrine.entity_manager'];

        $helperSet = ConsoleRunner::createHelperSet($em);
        $helperSet->set(new QuestionHelper(),'dialog');

        $configuration = new Configuration($em->getConnection());
        $configuration->setMigrationsNamespace('Migrations');
        $configuration->setMigrationsTableName('Migration');
        $this->app = new Application();
        $mig = new Migration();
        $mig->setMigrationConfiguration($configuration);
        $this->app->add($mig);
        $this->app->add(new VersionCommand());
    }

    protected function _after()
    {
        unset($this->app);
    }


    public function testVendorArgument()
    {
        $this->expectException('InvalidArgumentException');
        $command = $this->app->find('migrate');
        $test = new CommandTester($command);
        $test->execute(array('command' => $command->getName(), 'vendor' => 'bin'));
    }
}
