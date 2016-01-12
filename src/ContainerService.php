<?php
namespace Del\Common;

use Pimple\Container as PimpleContainer;
use Del\Common\Container\RegistrationInterface;
use Del\Common\Config\DbCredentials;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class ContainerService
{
    /**
     * @var PimpleContainer
     */
    private $container;

    /**
     * @var DbCredentials
     */
    private $credentials;

    /**
     * @var array
     */
    private $paths;

    public function __construct(){}
    public function __clone(){}

    public static function getInstance()
    {
        static $inst = null;
        if($inst === null)
        {
            $inst = new ContainerService();
            $inst->container = new PimpleContainer();
            $inst->paths = ['src/Entity'];
        }
        return $inst;
    }


    /**
     * @return PimpleContainer
     */
    public function getContainer()
    {
            $this->container['db.credentials'] = $this->getDbCredentials()->toArray();

            $this->container['entity.paths'] = $this->getEntityPaths();

            // The Doctrine Entity Manager
            $this->container['doctrine.entity_manager'] = $this->container->factory(function ($c) {

                $isDevMode = false;

                $paths = $c['entity.paths'];

                $dbParams = $c['db.credentials'];

                $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
                $entityManager = EntityManager::create($dbParams, $config);

                return $entityManager;
            });
        return $this->container;
    }



    /**
     * @param string $path
     * @return $this
     */
    public function addEntityPath($path)
    {
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


    public function registerToContainer(RegistrationInterface $config)
    {
        $config->addToContainer($this->container);
    }
}
