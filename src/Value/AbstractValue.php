<?php
/**
 * User: delboy1978uk
 * Date: 13/11/2016
 * Time: 13:23
 */

namespace Del\Common\Value;


abstract class AbstractValue
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
}