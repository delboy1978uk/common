<?php

namespace Del\Common\ZF1\Controller;

use Del\Common\ContainerService;
use Exception;
use Zend_Auth;
use Zend_Controller_Action;
use Zend_Layout;

class AbstractController extends Zend_Controller_Action
{
    protected $container;

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

    /**
     *
     */
    public function sendJSONResponse(array $array)
    {
        Zend_Layout::getMvcInstance()->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        $this->_helper->json($array);
    }

    public function getIdentity()
    {
        if(Zend_Auth::getInstance()->hasIdentity()) {
            return Zend_Auth::getInstance()->getIdentity();
        }
        throw new Exception('No Identity.');
    }

    /**
     * @return Zend_Controller_Request_Http
     */
    public function getRequest()
    {
        return parent::getRequest();
    }
}