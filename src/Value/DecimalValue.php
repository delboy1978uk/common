<?php
/**
 * User: delboy1978uk
 * Date: 13/11/2016
 * Time: 13:26
 */

namespace Del\Common\Value;

use InvalidArgumentException;

class DecimalValue extends AbstractValue
{
    /**
     * IntValue constructor.
     *
     * @param float $value
     */
    public function __construct($value)
    {
        if(!is_numeric($value)) {
            throw new InvalidArgumentException('Please supply a numeric value');
        }
        $this->value = (float) number_format((float) $value, 2,'.','');
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return parent::getValue();
    }
}