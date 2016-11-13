<?php
/**
 * User: delboy1978uk
 * Date: 13/11/2016
 * Time: 13:26
 */

namespace Del\Common\Value;


class StringValue extends AbstractValue
{
    /**
     * StringValue constructor.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return parent::getValue();
    }
}