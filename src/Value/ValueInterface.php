<?php
/**
 * User: delboy1978uk
 * Date: 19/11/2016
 * Time: 13:40
 */

namespace Del\Common\Value;

interface ValueInterface
{
    /**
     * ValueInterface constructor.
     * @param mixed $value
     */
    public function __construct($value);

    /**
     * @return mixed
     */
    public function getValue();
}