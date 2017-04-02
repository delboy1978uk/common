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
    /** @var bool $stringable */
    private $stringable;

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
        $this->stringable = false;
        $this->isStringableObject($value);
        $this->isNullValue($value);
        $this->isScalarValue($value);
        return $this->stringable;
    }

    /**
     * @param $value
     */
    private function isStringableObject($value)
    {
        $bool = is_object($value) && method_exists($value, '__toString');
        $this->updateStringable($bool);
    }

    /**
     * @param $value
     */
    private function isNullValue($value)
    {
        $bool = is_null($value);
        $this->updateStringable($bool);
    }

    /**
     * @param $value
     */
    private function isScalarValue($value)
    {
        $bool = is_scalar($value);
        $this->updateStringable($bool);
    }

    /**
     * @param $bool
     */
    private function updateStringable($bool)
    {
        if ($this->stringable === false) {
            $this->stringable = $bool;
        }
    }
}