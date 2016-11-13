<?php
/**
 * User: delboy1978uk
 * Date: 13/11/2016
 * Time: 13:26
 */

namespace Del\Common\Value;

use InvalidArgumentException;

class IntValue extends AbstractValue
{
    /**
     * IntValue constructor.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        if(!is_numeric($value)) {
            throw new InvalidArgumentException('Please supply a numeric value');
        }
        $this->value = (int) $value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return parent::getValue();
    }
}