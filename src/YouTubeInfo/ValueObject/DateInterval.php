<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 17/10/16
 * Time: 21:42
 */

namespace YouTubeInfo\ValueObject;


use StdDomain\ValueObject\InvalidNativeArgumentException;
use StdDomain\ValueObject\ValueObjectInterface;

class DateInterval implements ValueObjectInterface
{
    const INVALID_FORMAT = 'invalidIntervalFormat';

    /**
     * @var \DateInterval
     */
    protected $dateInterval;

    /**
     * @return DateInterval
     */
    public static function fromNative()
    {
        return new static(@\func_get_arg(0));
    }

    public function __construct($value)
    {
        try {
            $this->dateTime = new \DateInterval($value);
        } catch (\Exception $e) {
            throw new InvalidNativeArgumentException("Invalid interval format", self::INVALID_FORMAT);
        }
    }

    /**
     * @return string
     */
    public function toNative()
    {
        return (string)$this->dateInterval;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toNative();
    }

}