<?php

namespace YouTubeInfo\ValueObject;

use StdDomain\ValueObject\InvalidNativeArgumentException;
use StdDomain\ValueObject\ValueObjectInterface;
use StdDomain\ValueObject\ValueObjectTrait;

class IntegerNumber implements ValueObjectInterface
{
    use ValueObjectTrait;

    const ERR_NOT_INT = 'notInt';

    public function __construct($value)
    {
        if(!is_numeric($value)) {
            throw new InvalidNativeArgumentException("Value is not a number (" . print_r($value, true) . ")", self::ERR_NOT_INT);
        }
        $this->value = (int)$value;
    }
}