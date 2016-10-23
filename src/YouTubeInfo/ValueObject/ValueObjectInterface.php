<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 30/08/16
 * Time: 12:36
 */

namespace YouTubeInfo\ValueObject;


interface ValueObjectInterface
{
    public static function fromNative();
    public function toNative();
    public function __toString();
}