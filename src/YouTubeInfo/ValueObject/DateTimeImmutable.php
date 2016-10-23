<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 17/08/16
 * Time: 21:53
 */

namespace YouTubeInfo\ValueObject;


final class DateTimeImmutable extends DateTime
{
    public function __construct($value = null)
    {
        $this->dateTime = new \DateTimeImmutable($value ?? "now");
    }
}