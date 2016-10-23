<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 17/10/16
 * Time: 21:42
 */

namespace YouTubeInfo\ValueObject;


class DateInterval implements ValueObjectInterface
{
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
        $this->dateTime = new \DateInterval($value);
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