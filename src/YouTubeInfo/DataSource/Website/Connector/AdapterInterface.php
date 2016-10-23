<?php
/**
 * Created by PhpStorm.
 * User: tomaszchmielewski
 * Date: 23/10/16
 * Time: 13:15
 */

namespace YouTubeInfo\DataSource\Website\Connector;


use YouTubeInfo\ValueObject\StringValue;

interface AdapterInterface
{
    /**
     * @param StringValue $ytId
     * @return StringValue
     */
    public function retrieve(StringValue $ytId): StringValue;
}