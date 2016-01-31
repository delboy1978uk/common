<?php

namespace Del\Common\ZF1\Controller;

use Del\Common\ContainerService;
use Exception;
use Zend_Auth;
use Zend_Controller_Action;
use Zend_Layout;

class AbstractController extends Zend_Controller_Action
{

    /**
     * @param $key
     * @return mixed
     */
    public function getContainerObject($key)
    {
        return ContainerService::getInstance()->getContainer()[$key];
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
}