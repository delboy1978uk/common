<?php

use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;

use Doctrine\ORM\Tools\Console\ConsoleRunner;

use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;

$credentials = new DbCredentials();
$container = ContainerService::getInstance()
                    ->setDbCredentials($credentials)
                    ->addEntityPath('src/Entity')
                    ->getContainer();


// Fetch the entity Manager
$em = $container['doctrine.entity_manager'];

// Create the helperset
$helperSet = ConsoleRunner::createHelperSet($em);
$helperSet->set(new \Symfony\Component\Console\Helper\QuestionHelper(),'dialog');

/** Migrations setup */

$configuration = new Configuration($em->getConnection());
$configuration->setMigrationsDirectory('migrations');
$configuration->setMigrationsNamespace('migrations');
$configuration->setMigrationsTableName('Migration');

//$delmigrate = new Migration();
$diff = new DiffCommand();
$exec = new ExecuteCommand();
$gen = new GenerateCommand();
$migrate = new MigrateCommand();
$status = new StatusCommand();
$ver = new VersionCommand();

$diff->setMigrationConfiguration($configuration);
$exec->setMigrationConfiguration($configuration);
$gen->setMigrationConfiguration($configuration);
$migrate->setMigrationConfiguration($configuration);
$status->setMigrationConfiguration($configuration);
$ver->setMigrationConfiguration($configuration);



$cli = ConsoleRunner::createApplication($helperSet,[
    $diff, $exec, $gen, $migrate, $status, $ver
]);

return $cli->run();

