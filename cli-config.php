<?php

use Del\Common\Command\Migration;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand;

use Doctrine\ORM\Tools\Console\ConsoleRunner;

use Del\Common\ContainerService;
use Del\Common\DbCredentials;

$credentials = new DbCredentials();
$container = ContainerService::getInstance()
                    ->setDbCredentials($credentials->toArray())
                    ->getContainer();


// Fetch the entity Manager
$em = $container['doctrine.entity_manager'];

// Create the helperset
$helperSet = ConsoleRunner::createHelperSet($em);
$helperSet->set(new \Symfony\Component\Console\Helper\DialogHelper(),'dialog');

/** Migrations setup */
$path = realpath(getcwd().'/migrations');


$configuration = new Configuration($em->getConnection());
$configuration->setMigrationsDirectory('migrations');
$configuration->setMigrationsNamespace('migrations');

$delmigrate = new Migration();
$diff = new DiffCommand();
$exec = new ExecuteCommand();
$gen = new GenerateCommand();
$migrate = new MigrateCommand();
$status = new StatusCommand();
$ver = new VersionCommand();

$diff->setMigrationConfiguration($configuration);
$migrate->setMigrationConfiguration($configuration);


$cli = ConsoleRunner::createApplication($helperSet,[
    $diff, $exec, $gen, $delmigrate, $migrate, $status, $ver
]);

return $cli->run();

