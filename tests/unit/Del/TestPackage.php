<?php

namespace DelTesting;

use Barnacle\Container;
use Barnacle\RegistrationInterface;

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