<?php

use Pimple\Container;
use Del\Common\DbCredentials;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$container = new Container();

// The Entity Paths Array
$container['entity.paths'] = [__DIR__ . "/Entity"];
$container['db.credentials'] = DbCredentials::getInstance()->getCredentials();

// The Doctrine Entity Manager
$container['doctrine.entity_manager'] = $container->factory(function ($c) {

    $paths = $c['entity.paths'];

    $isDevMode = false;

    $dbParams = $c['db.credentials'];
    if(!isset($dbParams)) {
        throw new InvalidArgumentException('You must set the db.credentials array in the container before accessing this');
    }

    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    $entityManager = EntityManager::create($dbParams, $config);

    return $entityManager;
});

return $container;
