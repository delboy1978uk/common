<?php

namespace DelTesting;

use Del\Common\Container\RegistrationInterface;
use Pimple\Container;

class TestPackage implements RegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $c['test.package'] = 'A boring old string.';
    }

    /**
     * @return string
     */
    function getEntityPath()
    {
        return 'test/entity/path';
    }

    /**
     * @return mixed
     */
    function hasEntityPath()
    {
        return true;
    }

}