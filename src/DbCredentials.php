<?php


namespace Del\Common;


class DbCredentials
{
    /** @var  array */
    private $credentials;
    
    public function __construct(array $array = null)
    {
        $this->credentials = [];
        if($array != null){
            $this->credentials['driver'] = $array['driver'] ?: 'pdo_mysql';
            $this->credentials['database'] = $array['database'] ?: 'delboy1978uk';
            $this->credentials['user'] = $array['user'] ?: 'dbuser';
            $this->credentials['password'] = $array['password'] ?: '[123456]';
        }
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
        return $this->credentials['database'];
    }

    /**
     * @param string $database
     * @return DbCredentials
     */
    public function setDatabase($database)
    {
        $this->credentials['database'] = $database;
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
}