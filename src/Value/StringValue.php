<?php
/**
 * User: delboy1978uk
 * Date: 13/11/2016
 * Time: 13:26
 */

namespace Del\Common\Value;

use InvalidArgumentException;

class StringValue extends AbstractValue
{
    /**
     * StringValue constructor.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        if(!$this->canBeString($value)) {
            throw new InvalidArgumentException('You must supply a value.');
        }
        $this->value = (string) $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return parent::getValue();
    }

    /**
     * @param $value
     * @return bool
     */
    private function canBeString($value)
    {
        switch(true) {
            case is_object($value) && method_exists($value, '__toString'):
            case is_null($value):
            case is_scalar($value):
                return true;
            default:
                return false;
        }
    }
}