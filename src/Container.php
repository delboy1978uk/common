<?php
namespace Del\Common;

use InvalidArgumentException;
use Pimple\Container as PimpleContainer;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class Container
{
    private $credentials = [];
    private $paths = [];

    public function __construct(){}
    public function __clone(){}

    public static function getInstance()
    {
        static $inst = null;
        if($inst === null)
        {
            $inst = new Container();
        }
        return $inst;
    }


    /**
     * @return PimpleContainer
     */
    public function getContainer()
    {
        $container = new PimpleContainer();

        $container['db.credentials'] = $this->getDbCredentials();

        $container['entity.paths'] = $this->getEntityPaths();

        // The Doctrine Entity Manager
        $container['doctrine.entity_manager'] = $container->factory(function ($c) {

            $isDevMode = false;

            $paths = $c['entity.paths'];
            if(!isset($paths)) {
                throw new InvalidArgumentException('You must set the entity.paths array with at least one path before calling getContainer()');
            }

            $dbParams = $c['db.credentials'];
            if(!isset($dbParams)) {
                throw new InvalidArgumentException('You must set the db.credentials array in the container before calling getContainer()');
            }

            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            $entityManager = EntityManager::create($dbParams, $config);

            return $entityManager;
        });

        return $container;
    }

    /**
     * @param $path
     * @return PimpleContainer
     */
    public function addDefinition($key, $value)
    {
        $c = $this->getContainer();
        $c[$key] = $value;
        return $c;
    }

    /**
     * @param string $path
     * @return PimpleContainer
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
     * @return array
     */
    public function getDbCredentials()
    {
        if(isset($this->credentials['driver']) && isset($this->credentials['dbname']) && isset($this->credentials['user']) && isset($this->credentials['password']) ){
            return $this->credentials;
        }
        return [
            'driver' => 'pdo_mysql',
            'dbname' => 'delboy1978uk',
            'user' => 'dbuser',
            'password' => '[123456]',
        ];
    }

    /**
     * @param array $credentials
     * @return $this
     */
    public function setDbCredentials(array $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }
}
