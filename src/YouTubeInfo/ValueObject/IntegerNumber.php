<?php

namespace YouTubeInfo\ValueObject;

class IntegerNumber implements ValueObjectInterface
{
    use SimpleValueObjectTrait;

    const ERR_NOT_INT = 'notInt';

    public function __construct($value)
    {
        if(!is_numeric($value)) {
            throw new InvalidNativeArgumentException("Value is not a number (" . print_r($value, true) . ")", self::ERR_NOT_INT);
        }
        $this->value = (int)$value;
    }
}