<?php


namespace Del\Common\Config;

use Del\Common\Container\RegistrationInterface;
use Pimple\Container;

class DbCredentials implements RegistrationInterface
{
    /** @var  array */
    private $credentials = [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'dbname' => '',
        'user' => 'userhere',
        'password' => 'passwordhere',
    ];
    
    public function __construct(array $array = [])
    {
        $this->credentials = array_merge($this->credentials, $array);
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
    public function getHost()
    {
        return $this->credentials['host'];
    }

    /**
     * @param string $database
     * @return DbCredentials
     */
    public function setHost($host)
    {
        $this->credentials['host'] = $host;
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

    /**
     * @return null
     */
    public function getEntityPath()
    {
        return null;
    }

    /**
     * @return bool
     */
    public function hasEntityPath()
    {
        return false;
    }
}
