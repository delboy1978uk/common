<?php


namespace Del\Common\Config;

use Del\Common\Container\RegistrationInterface;
use Pimple\Container;

class DbCredentials implements RegistrationInterface
{
    /** @var  array */
    private $credentials;
    
    public function __construct(array $array = null)
    {
        $this->credentials = [];
        $this->credentials['driver'] = $array['driver'] ?: 'pdo_mysql';
        $this->credentials['dbname'] = $array['dbname'] ?: 'delboy1978uk';
        $this->credentials['user'] = $array['user'] ?: 'dbuser';
        $this->credentials['password'] = $array['password'] ?: '[123456]';
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->credentials['password'];
    }

    /**
     * @param string $password
     * @return DbCredentials
     */
    public function setPassword($password)
    {
        $this->credentials['password'] = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->credentials['user'];
    }

    /**
     * @param string $user
     * @return DbCredentials
     */
    public function setUser($user)
    {
        $this->credentials['user'] = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getDatabase()
    {
        return $this->credentials['dbname'];
    }

    /**
     * @param string $database
     * @return DbCredentials
     */
    public function setDatabase($database)
    {
        $this->credentials['dbname'] = $database;
        return $this;
    }

    /**
     * @return string
     */
    public function getDriver()
    {
        return $this->credentials['driver'];
    }

    /**
     * @param string $driver
     * @return DbCredentials
     */
    public function setDriver($driver)
    {
        $this->credentials['driver'] = $driver;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->credentials;
    }

    /**
     * @param Container $c
     * @return Container
     */
    public function addToContainer(Container $c)
    {
        $c['db.credentials'] = $this->toArray();
        return $c;
    }


}