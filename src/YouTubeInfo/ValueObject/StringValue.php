<?php

namespace YouTubeInfo\ValueObject;


class StringValue extends StringLiteral
{
    const ERR_EMPTY_VALUE = 'emptyValue';

    public function __construct($value)
    {
        parent::__construct($value);
        if($value == "") {
            throw new InvalidNativeArgumentException("Value cannot be empty", self::ERR_EMPTY_VALUE);
        }
        $this->value = $value;
    }
}