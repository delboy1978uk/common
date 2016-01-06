<?php
/**
 * User: delboy1978uk
 * Date: 06/01/16
 * Time: 20:52
 */

namespace Del\Common\Container;

use Pimple\Container;

interface RegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c);
}