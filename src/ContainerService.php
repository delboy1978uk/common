<?php
namespace Del\Common;

use Pimple\Container as PimpleContainer;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class ContainerService
{
    private $credentials;
    private $paths;

    public function __construct(){}
    public function __clone(){}

    public static function getInstance()
    {
        static $inst = null;
        if($inst === null)
        {
            $inst = new ContainerService();
        }
        return $inst;
    }


    /**
     * @return PimpleContainer
     */
    public function getContainer()
    {
        $container = new PimpleContainer();

        $container['db.credentials'] = $this->getDbCredentials()->toArray();

        $container['entity.paths'] = $this->getEntityPaths();

        // The Doctrine Entity Manager
        $container['doctrine.entity_manager'] = $container->factory(function ($c) {

            $isDevMode = false;

            $paths = isset($c['entity.paths']) ? $c['entity.paths'] : ['src/Entity'];

            $dbParams = $c['db.credentials'];

            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            $entityManager = EntityManager::create($dbParams, $config);

            return $entityManager;
        });

        return $container;
    }
    /**
     * @param string $path
     * @return $this
     */
    public function addEntityPath($path)
    {
        if(!isset($this->paths)) {
            $this->paths = [];
        }
        $this->paths[] = $path;
        return $this;
    }

    /**
     * @return array
     */
    public function getEntityPaths()
    {
        return $this->paths;
    }

    /**
     * @return DbCredentials
     */
    public function getDbCredentials()
    {
        return $this->credentials ? $this->credentials : new DbCredentials();
    }

    /**
     * @param DbCredentials $credentials
     * @return $this
     */
    public function setDbCredentials(DbCredentials $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }
}
