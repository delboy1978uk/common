<?php

namespace DelTesting;

use Del\Common\Container\RegistrationInterface;
use Barnacle\Container;

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
    function getEntityPath(): string
    {
        return 'tests/unit';
    }

    /**
     * @return mixed
     */
    function hasEntityPath(): bool
    {
        return true;
    }

}