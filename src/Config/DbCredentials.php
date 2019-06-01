<?php

namespace Del\Common\Config;

use Del\Common\Container\RegistrationInterface;
use Barnacle\Container;

class DbCredentials implements RegistrationInterface
{
    /** @var  array $credentials */
    private $credentials;

    /**
     * DbCredentials constructor.
     * @param array|null $array
     */
    public function __construct(array $array = null)
    {
        $this->credentials = [];
        $this->credentials['driver'] = $array['driver'];
        $this->credentials['dbname'] = $array['dbname'];
        $this->credentials['user'] = $array['user'];
        $this->credentials['password'] = $array['password'];
        $this->credentials['host'] = $array['host'] ?: '127.0.0.1';
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->credentials['password'];
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->credentials['password'] = $password;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->credentials['user'];
    }

    /**
     * @param string $user
     * @return DbCredentials
     */
    public function setUser(string $user)
    {
        $this->credentials['user'] = $user;
    }

    /**
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->credentials['dbname'];
    }

    /**
     * @param string $database
     */
    public function setDatabase(string $database)
    {
        $this->credentials['dbname'] = $database;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->credentials['host'];
    }

    /**
     * @param string $database
     */
    public function setHost(string $host)
    {
        $this->credentials['host'] = $host;
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->credentials['driver'];
    }

    /**
     * @param string $driver
     */
    public function setDriver(string $driver)
    {
        $this->credentials['driver'] = $driver;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->credentials;
    }

    /**
     * @param Container $c
     * @return Container
     */
    public function addToContainer(Container $c): Container
    {
        $c['db.credentials'] = $this->toArray();
        return $c;
    }

    /**
     * @return null
     */
    public function getEntityPath(): string
    {
        return null;
    }

    /**
     * @return bool
     */
    public function hasEntityPath(): bool
    {
        return false;
    }
}