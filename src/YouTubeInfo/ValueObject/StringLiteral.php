<?php

namespace YouTubeInfo\ValueObject;

use StdDomain\ValueObject\InvalidNativeArgumentException;
use StdDomain\ValueObject\ValueObjectInterface;
use StdDomain\ValueObject\ValueObjectTrait;

class StringLiteral implements ValueObjectInterface
{
    use ValueObjectTrait;

    const ERR_INVALID_STRING = 'invalidString';

    public function __construct($value)
    {
        if (false === \is_string($value)) {
            throw new InvalidNativeArgumentException("No value or value isn't a string", self::ERR_INVALID_STRING);
        }
        $this->value = $value;
    }
}