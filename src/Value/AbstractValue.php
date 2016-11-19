<?php
/**
 * User: delboy1978uk
 * Date: 13/11/2016
 * Time: 13:23
 */

namespace Del\Common\Value;

abstract class AbstractValue implements ValueInterface
{
    /** @var mixed $value */
    protected $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    abstract public function __construct($value);
}