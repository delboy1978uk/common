<?php
/**
 * User: delboy1978uk
 * Date: 29/12/15
 * Time: 03:22
 */

namespace Del\Common;

class DbCredentials
{
    private $credentials = [];

    public function __construct(){}
    public function __clone(){}

    public static function getInstance()
    {
        static $inst = null;
        if($inst === null)
        {
            $inst = new DbCredentials();
        }
        return $inst;
    }

    /**
     * @return array
     */
    public function getCredentials()
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
    public function setCredentials(array $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }
}



