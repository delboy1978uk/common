<?php

namespace Del\Common\ZF1\Controller;

use Del\Common\ContainerService;
use Zend_Controller_Action;

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
}