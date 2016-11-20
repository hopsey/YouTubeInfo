<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 23/10/16
 * Time: 14:57
 */

namespace YouTubeInfo\DataSource\Html\DomExtractor;

use YouTubeInfo\ValueObject\StringValue;

interface ExtractorInterface
{
    /**
     * @param string $name
     * @return mixed
     */
    public function extract($name);

    /**
     * @param StringValue $dom
     */
    public function setDom(StringValue $dom);
}