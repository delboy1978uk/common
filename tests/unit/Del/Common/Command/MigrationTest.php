<?php

namespace Del\Common\Command;

use Del\Common\Command\Migration;
use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand;
use Symfony\Component\Console\Helper\DialogHelper;

class MigrationTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var
     */
    protected $app;

    protected function _before()
    {
        $credentials = new DbCredentials();
        $container = ContainerService::getInstance()
            ->setDbCredentials($credentials)
            ->addEntityPath('src/Entity')
            ->getContainer();

        $em = $container['doctrine.entity_manager'];

        $helperSet = ConsoleRunner::createHelperSet($em);
        $helperSet->set(new DialogHelper(),'dialog');

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
        $this->setExpectedException('InvalidArgumentException');
        $command = $this->app->find('migrate');
        $test = new CommandTester($command);
        $test->execute(array('command' => $command->getName(), 'vendor' => 'bin'));
    }
}
