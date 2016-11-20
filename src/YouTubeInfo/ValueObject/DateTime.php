<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 17/08/16
 * Time: 21:47
 */

namespace YouTubeInfo\ValueObject;


use StdDomain\ValueObject\ValueObjectInterface;

class DateTime implements ValueObjectInterface
{
    /**
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * @return DateTime
     */
    public static function fromNative()
    {
        return new static(@\func_get_arg(0));
    }

    public function __construct($value = null)
    {
        $this->dateTime = new \DateTime($value ?? "now");
    }

    /**
     * @return string
     */
    public function toNative()
    {
        return $this->dateTime->format("Y-m-d H:i:s");
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toNative();
    }

}