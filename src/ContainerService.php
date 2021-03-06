<?php
namespace Del\Common;

use Barnacle\Container;
use Barnacle\EntityRegistrationInterface;
use Barnacle\RegistrationInterface;
use Del\Common\Config\DbCredentials;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class ContainerService
{
    /**
     * @var Container
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

    /** @var string $proxyPath */
    private $proxyPath;

    /** @var \Doctrine\ORM\Configuration $config */
    private $config;

    private function __construct(){}
    private function __clone(){}

    /**
     * @param Container|null $container
     * @return ContainerService|null
     */
    public static function getInstance(Container $container = null)
    {
        static $inst = null;
        if($inst === null)
        {
            $inst = new ContainerService();
            $inst->container = $container ?: new Container();
            $inst->paths = $inst->initEntityPaths();
        }
        return $inst;
    }

    /**
     *  by default looks for src/Entity
     *  or src/anything/Entity
     *
     * @return array
     */
    private function initEntityPaths(): array
    {
        $paths = [];
        $paths = $this->addPathIfExists($paths, 'src');
        $possibleModules = glob('src/*');

        foreach ($possibleModules as $path) {
            $paths = $this->addPathIfExists($paths, $path);
        }

        return $paths;
    }

    /**
     * @param array $paths
     * @param string $path
     * @return array
     */
    private function addPathIfExists(array $paths, string $path): array
    {
        if (is_dir($path . '/Entity')) {
            $paths[] = $path . '/Entity';
        }

        return $paths;
    }


    /**
     * @return Container
     * @throws \Doctrine\ORM\ORMException
     */
    public function getContainer()
    {
        if (!isset($this->dbInitialised)) {

            $this->container['db.credentials'] = $this->getDbCredentials()->toArray();
            $this->container['entity.paths'] = $this->getEntityPaths();

            $paths = $this->container['entity.paths'];
            $dbParams = $this->container['db.credentials'];
            $isDevMode = false;

            $this->config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
            $this->addProxyPath();
            $entityManager = EntityManager::create($dbParams, $this->config);

            // The Doctrine Entity Manager
            $this->container['doctrine.entity_manager'] = $entityManager;
            $this->container[EntityManager::class] = $entityManager;
            $this->container['dbInitialised'] = true;

        }
        return $this->container;
    }

    private function addProxyPath()
    {
        if(isset($this->proxyPath)) {
            $this->config->setProxyDir($this->proxyPath);
        }
    }


    /**
     * @param string $path
     * @return $this
     */
    public function addEntityPath($path)
    {
        if (is_dir($path)) {
            $this->paths[] = $path;
        }

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
     * @param string $proxyPath
     * @return ContainerService
     */
    public function setProxyPath($proxyPath)
    {
        $this->proxyPath = $proxyPath;
        return $this;
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

    /**
     * @param RegistrationInterface $config
     */
    public function registerToContainer(RegistrationInterface $config)
    {
        if($config instanceof EntityRegistrationInterface) {
            $this->addEntityPath($config->getEntityPath());
        }

        $config->addToContainer($this->container);
    }
}
