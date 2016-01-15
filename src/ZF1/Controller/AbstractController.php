<?php

namespace Del\Common\ZF1\Controller;

use Del\Common\ContainerService;
use Zend_Controller_Action;

class AbstractController extends Zend_Controller_Action
{
    /** @var  \Pimple\Container $container */
    private $container;

    public function init()
    {
        $this->container = ContainerService::getInstance()->getContainer();
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getContainerObject($key)
    {
        return $this->container[$key];
    }
}